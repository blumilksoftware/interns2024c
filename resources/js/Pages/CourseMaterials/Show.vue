<template>
  <div>
    <h1>{{ material.title }}</h1>
    <p>Type: {{ material.type }}</p>
    <p>Description: {{ material.description }}</p>
  </div>
</template>

<script>
export default {
  props: {
    material: Object
  }
};
</script>
