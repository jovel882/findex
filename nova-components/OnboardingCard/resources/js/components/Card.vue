<template>
  <ComponentTool></ComponentTool>
</template>

<script>
import ComponentTool from '../../../../Onboarding/resources/js/pages/Tool.vue'
export default {
  components: {
    ComponentTool
  },
  props: [
    'card',

    // The following props are only available on resource detail cards...
    // 'resource',
    // 'resourceId',
    // 'resourceName',
  ],

  mounted() {
    //
  },
}
</script>
