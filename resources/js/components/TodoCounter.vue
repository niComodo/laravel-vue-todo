<template>
    <div class="todo-counter">
        <div class="bg-blue" :class="{'bg-blue':totalCount !== 0}">total: {{ totalCount }}</div>
        <div class="bg-green">todo: {{ todoCount }}</div>
        <div class="text-green" :class="{'bg-green':!todoCount && doneCount !== 0}">done: {{ doneCount }}</div>
    </div>
</template>

<script>
export default {
    props: {
        todoList: Array,
    },
    computed: {
        doneCount() {
            return this.todoList.filter(item => item.is_done).length
        },
        todoCount() {
            return this.todoList.filter(item => !item.is_done).length
        },
        totalCount() {
            return this.todoList.length
        }
    }
}
</script>

<style scoped>
.todo-counter {
    margin-bottom: 20px;
}
.bg-blue {
    color: white;
    background-color: #34495D;
}

.text-green {
    color: #40B883;
}

.bg-green {
    color: white;
    background-color: #40B883;
}
</style>
