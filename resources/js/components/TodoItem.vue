<template>
    <li>
        <!--show-->
        <input type="checkbox" v-model="editedTodo.is_done" @change="updateTodo">
        <span v-show="!editing" :class="{'done':editedTodo.is_done}">{{ editedTodo.content }}</span>

        <!--update-->
        <span v-show="editing">
            <input type="text" v-model="editedTodo.content">
            <span class="icon text-green" @click="updateTodo">&#10004;</span>
            <span class="icon text-red" @click="closeEditMode">esc</span>
        </span>

        <!--edit/delete-->
        <span v-show="!editing">
            <span class="icon text-gray-400" @click="editTodo"><EditSvg/></span>
            <span class="icon text-red" @click="removeTodo">&#10008;</span>
        </span>
    </li>
</template>

<script>
import EditSvg from './EditSvg.vue'

export default {
    mounted() {
        this.reset() //faccio la copia dell'originale
    },
    data() {
        return {
            editing: false,
            editedTodo: {

            }
        }
    },
    props: {
        item: Object,
    },
    components: {
        EditSvg,
    },
    methods: {
        reset() {
            this.editedTodo = Object.assign({}, this.item) //faccio la copia dell'originale
        },
        editTodo() {
            this.editing = !this.editing
        },
        closeEditMode() {
            this.reset()
            this.editTodo()
        },
        updateTodo() {
            this.$emit('updateTodo', {
                clonedItem: Object.assign({}, this.editedTodo),
                reset: this.reset,
                done: () => {
                    this.editing = false
                }
            })
        },
        removeTodo() {
            this.$emit('removeTodo', this.item)
        }
    }
}
</script>

<style scoped>
.icon {
    cursor: pointer;
    margin-left: 10px;
}

.text-green {
    color: #40B883;
    font-weight: bold;
}

.text-red {
    color: red;
    font-weight: bold;
}

.done {
    text-decoration: line-through;
}

svg {
    display: inline-block;
}
</style>
