<template>
  <div>
    <VOnboardingWrapper ref="wrapper" :steps="stepsTemp" />    
    <Head title="Onboarding" />

    <Heading class="mb-6">Onboarding</Heading>

    <Card
      class="flex flex-col items-center justify-center"
      style="min-height: 300px"
    >
      <h1 class="dark:text-white text-4xl font-light mb-6">
        Haz click en los botones para ver el Onboarding.
      </h1>      
      <button @click="() => {finish(); goToStep(0);}" class=" mb-6 mt-6 flex-shrink-0 shadow rounded focus:outline-none ring-primary-200 dark:ring-gray-600 focus:ring bg-primary-500 hover:bg-primary-400 active:bg-primary-600 text-white dark:text-gray-800 inline-flex items-center font-bold px-4 h-9 text-sm flex-shrink-0" v-if="!errorMessage">Paso 1</button>
      <button @click="() => {finish();goToStep(1);}" class=" mb-6 mt-6 flex-shrink-0 shadow rounded focus:outline-none ring-primary-200 dark:ring-gray-600 focus:ring bg-primary-500 hover:bg-primary-400 active:bg-primary-600 text-white dark:text-gray-800 inline-flex items-center font-bold px-4 h-9 text-sm flex-shrink-0" v-if="!errorMessage">Paso 2</button>
      <button @click="() => {finish();goToStep(2);}" class=" mb-6 mt-6 flex-shrink-0 shadow rounded focus:outline-none ring-primary-200 dark:ring-gray-600 focus:ring bg-primary-500 hover:bg-primary-400 active:bg-primary-600 text-white dark:text-gray-800 inline-flex items-center font-bold px-4 h-9 text-sm flex-shrink-0" v-if="!errorMessage">Paso 3</button>
      <h1 class="text-red-600 text-2xl font-light mb-6 mt-6 underline" v-if="errorMessage">Fallo la conexion con el api, esta es la razon: {{ errorMessage }}</h1>
    </Card>
  </div>
</template>

<script>
import { defineComponent, ref, onMounted  } from 'vue'
import { VOnboardingWrapper, useVOnboarding } from 'v-onboarding'
import 'v-onboarding/dist/style.css'
export default defineComponent ({
  props: {
    errorMessage: false,
    stepsTemp: false,
  },  
  components: {
    VOnboardingWrapper
  },  
  setup(props) {    
    const wrapper = ref(null)
    const { start, goToStep, finish } = useVOnboarding(wrapper)
    const steps = []
    const response = async () => {
      try {
        const response = await Nova.request().get('/nova-vendor/onboarding/')
        props.stepsTemp = [
            {
              attachTo: { element: () => {
                  const nodeList = document.querySelectorAll("span.flex.items-center.sidebar-item-label");
                  return nodeList[1];
                } 
              },
              content: { title: response.data[0] }
            },
            {
              attachTo: { element: () => {
                  const nodeList = document.querySelectorAll("tbody>tr");
                  return nodeList[0];
                } 
              },
              content: { title: response.data[1] }        
            },
            {
              attachTo: { element: '.flex-shrink-0.ml-auto>a' },
              content: { title: response.data[2] }        
            }
        ]
      } catch (error) {
        props.errorMessage = error
        props.stepsTemp = []
      }      
    };
    response()
    onMounted(() => {finish();})
    return {
      wrapper,
      steps,
      start,
      finish,
      goToStep,
    }
  },
})
</script>
