<template>
    <div>
        <Alert :msg="alert.msg" :type="alert.type"/>
        <h2>{{ titolo }}</h2>

        <!--aggiungi nuovo todo-->
        <AddTodo @createTodo="add"/>

        <div v-if="loading">caricamento in corso</div>

        <!--statistiche todo-->
        <TodoCounter :todoList="todoList"/>

        <!--lista todo-->
        <div class="todo-list">
            <TodoItem v-for="(item) in todoList" v-bind:key="item.id"
                      v-show="!item.deleted"
                      :item="item"
                      @updateTodo="update"
                      @removeTodo="remove"/>
        </div>
    </div>
</template>

<script>
import AddTodo from './AddTodo.vue'
import TodoItem from './TodoItem.vue'
import TodoCounter from './TodoCounter.vue'
import Alert from './Alert.vue'
import bus from "../bus"

export default {
    name: 'Todo',
    mounted() {
        this.todoList = this.todos.map(item => { //aggiungo proprietà nel mounted per renderle reattive
            item.deleted = false //per nascondere momentaneamente l'item al momento dell'eliminazione
            return item
        })
    },
    data() {
        return {
            titolo: 'Todo List',
            todoList: [],
            loading: false,
            alert: {
                msg: null,
                type: 'success'
            }
        }
    },
    props: {
        newTodoContent: String,
        todos: Array,
    },
    components: {
        AddTodo,
        TodoItem,
        TodoCounter,
        Alert,
    },
    methods: {
        async add(todo) {
            this.loading = true
            try {
                const response = await axios.post('/todo-list', todo);
                this.todoList.push(response.data)
            } catch (e) {
                this.notify('qualcosa è andato storto', 'danger')
            }
            this.loading = false

            // axios.post('/todo-list', todo).then((r) => { //se success => then: fai qualcosa
            //     this.todoList.push(r.data)
            //     this.loading = false
            // }).catch() //errori
        },
        async update({clonedItem, reset, done}) {
            this.loading = true
            try {
                const response = await axios.patch('/todo-list/' + clonedItem.id, clonedItem);
                done()
                const index = this.findItemIndex(clonedItem)
                this.$set(this.todoList, index, clonedItem)
            } catch (e) {
                reset()
                this.notify('Qualcosa è andato storto', 'warning')
            }
            this.loading = false
        },
        async remove(item) {
            this.loading = true
            try {
                item.deleted = true
                const index = this.findItemIndex(item)
                const response = await axios.delete('/todo-list/' + item.id);
                this.todoList.splice(index, 1)

                //content dell'item eliminato che mostrerò nel messaggio di notifica
                let todoDeleted = response.data.content
                this.notify(todoDeleted + ' rimosso correttamente')
            } catch (e) {
                item.deleted = false
                this.notify('Qualcosa è andato storto', 'danger')
            }
            this.loading = false
        },
        notify(msg, type = 'success') {
            this.alert.msg = msg
            this.alert.type = type
        },
        findItemIndex(item) {
            return this.todoList.findIndex(oldItem => oldItem.id === item.id)
        }
    },
}
</script>

<style scoped>
#todo {
    text-align: center;
}

.todo-list {
    list-style-type: none;
}
</style>
