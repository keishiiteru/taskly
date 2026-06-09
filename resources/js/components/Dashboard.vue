<template>
    <h1>Welcome to Dashboard!</h1>
      <pre>{{ result }}</pre>
</template>

<script setup>
    import { onMounted, ref } from 'vue'

    const result = ref(null)

    onMounted(async () => {
    const { data } = await axios.get('/api/test')
    result.value = data
    })
</script>
