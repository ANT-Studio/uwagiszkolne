<template>
    <div class="home">
        <h1>Najnowsze uwagi!</h1>
        <div class="notes">
            <note v-for="note in notes" :key="note.content" :note="note" :admin="admin" v-on:reloadNotes="loadNotes"/>
        </div>
    </div>
</template>

<script>
import Note from "../components/Note";
import UserController from "../UserController";
import axios from "axios";
export default {
    name: "Home",
    components: { Note },
    data() {
        return {
            notes: [],
            admin: false,
        }
    },
    async mounted() {
        await this.loadNotes()
        this.admin = await UserController.admin();
    },
    methods: {
        async loadNotes() {
            await axios.get("/api/note/index").then(request => {
                if (request.status === 200) {
                    this.notes = request.data.data;
                    console.log(request.data.data)
                }
            });
        }
    }
}
</script>

<style lang="scss" scoped>
    .home {
        .notes {
            display: flex;
            flex-wrap: wrap;

            .note {
                margin-bottom: 20px;
            }
        }
    }
</style>
