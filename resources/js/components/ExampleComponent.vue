<template>
    <div>
        <button type="submit" class="my-button">My button</button>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>

<style>
    .my-button {
        background-color: #333;
    }
</style>