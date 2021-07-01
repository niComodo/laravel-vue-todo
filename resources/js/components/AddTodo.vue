<template>
    <div class="add-todo">
        <input type="text" v-model="newTodoContent">
        <button @click="addTodo">aggiungi</button>
    </div>
</template>

<script>
export default {
    name: 'AddTodo',
    data() {
        return {
            newTodoContent: '',
        }
    },
    methods: {
        addTodo() {
            if (this.newTodoContent) {
                const todo = {
                    content: this.newTodoContent,
                    is_done: false
                }
                this.$emit('createTodo', todo) //emetto un evento che gestirà il padre (Todo.vue)
                this.newTodoContent = ''
            }

        },
    },
}
</script>

<style scoped>
.add-todo {
    margin-bottom: 20px;
}
</style>
