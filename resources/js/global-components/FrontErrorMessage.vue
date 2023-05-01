<template lang="">
    <div class="input-errors" v-for="error of props.errors" :key="error.$uid">
        <div class="text-sm text-red-600">
            {{ error.$message }}
        </div>
    </div>
</template>
<script setup>
const props = defineProps({
    errors: Array,
});
</script>
<style lang=""></style>
