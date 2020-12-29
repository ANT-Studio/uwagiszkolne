<template>
    <div class="home">
        <h1>Najnowsze uwagi!</h1>
        <div class="notes">
            <Note v-for="note in notes" :key="note.content" :note="note" :admin="admin" @reloadNotes="loadNotes" />
        </div>
    </div>
</template>

<script>
import Note from "../components/Note";
import UserController from "../UserController";
import NotesController from '../NotesController';
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
        await this.loadNotes();
        this.admin = await UserController.admin();
    },
    methods: {
        async loadNotes() {
            await axios.get("/api/note/index").then(async request => {
                if (request.status === 200) {
                    try {
                        let userId = await UserController.getUser().id;
                        this.notes = NotesController.updateNotes(request.data.data, userId);
                    }
                    catch (e) {
                        this.notes = NotesController.updateNotes(request.data.data, -1);
                    }
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
            gap: 30px;

            .note {
                margin-bottom: 20px;
            }
        }
    }
</style>
