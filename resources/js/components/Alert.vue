<template>
    <p v-if="msg"
       class="alert"
       :class="{'bg-green': this.type === 'success', 'bg-red': this.type === 'danger', 'bg-yellow': this.type === 'warning'}">{{ msg }}</p>
</template>

<script>
export default {
    props: {
        msg: String,
        type: {
            default: 'success',
            type: String
        }
    }
}
</script>

<style scoped>
.alert {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    padding: 10px;
    color: white;
    font-weight: bold;
}

.bg-green {
    background-color: green;
}

.bg-red {
    background-color: red;
}

.bg-yellow {
    color: black;
    background-color: yellow;
}
</style>
