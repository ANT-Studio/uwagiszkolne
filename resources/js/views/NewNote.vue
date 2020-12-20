<template>
    <h1>Dodaj nową uwagę!</h1>
    <form @submit.prevent="handleAdd()" class="add" v-if="logged">
        <textarea placeholder="Wpisz tutaj swoją uwagę!" v-model="text"/>
        <input type="submit" value="Dodaj!" />
        <span>{{ error }}</span>
    </form>
    <div class="info" v-else>
        Wybacz, ale nie jesteś zalogowany, co oznacza że nie możesz dodawać nowych uwag. Zaloguj się <router-link :to="{name: 'Login'}">tutaj</router-link>.
    </div>
</template>

<script>
import axios from "axios";

export default {
    name: "NewNote",
    data(){
        return{
            logged: localStorage.getItem('logged') === 'true',
            text: "",
            error: ""
        }
    },
    methods: {
        handleAdd(){
            if(this.text === ""){
                this.error = "Musisz wypełnić pole uwagi";
                return;
            }
            axios.put('/api/note/add', {content: this.text}).then(req => {
                if(req.data.message === ""){
                    this.text = "";
                    this.error = "Dodano twoją uwagę!";
                }
            }).catch(e => {
                console.log(e);
            })
        }
    }

}
</script>

<style lang="scss" scoped>
    .add{
        display: flex;
        flex-direction: column;

        textarea{
            resize: none;
            outline: none;
            border: none;
            background: #eee;
            width: 40%;
            min-height: 200px;
            padding: 20px;

            &::placeholder{
                color: #ccc;
                font-weight: bold;
            }
        }

        input[type="submit"]{
            cursor: pointer;
            background: #FFD600;
            height: 50px;
            font-size: 1.2rem;
            color: black;
            font-weight: bold;
            width: 170px;
            margin: 30px 0;
            border-radius: 9px;
            outline: none;
            border: none;
        }
    }
</style>
