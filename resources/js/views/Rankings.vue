<template>
    <div class="rankings">
        <h1>Rankingi</h1>
        <div class="notes-container" v-for="(notes, i) in notesArray" :key="notes">
            <h2>Ranking {{ typesNames[i] }}</h2>
            <br>
            <div class="notes" v-if="notes.length >= 1">
                <div v-for="(note, j) in notes" :key="note.content" class="note-container">
                    <h3>{{ j + 1 }}. miejsce</h3>
                    <Note :note="note" :admin="admin" @reloadNotes="loadNotes" />
                </div>
            </div>
            <div class="notes" v-else>
                Lista uwag jest pusta!
            </div>
            <br><br>
        </div>
    </div>
</template>

<script>
import Note from "../components/Note";
import UserController from "../UserController";
import NotesController from '../NotesController';
import axios from "axios";

export default {
    name: "Rankings",
    components: { Note },
    data() {
        return {
            notesArray: [],
            types: ['all', 'year', 'month', 'week'],
            typesNames: ['ogólny', 'roku', 'miesiąca', 'tygodnia'],
            admin: false,
        }
    },
    async mounted() {
        await this.loadNotes();
        this.admin = await UserController.admin();
        console.log(this.notesArray);
    },
    methods: {
        async loadNotes() {
            for (const type of this.types) {
                let request = await axios.post("/api/note/ranking", { amount: 5, type });
                if (request.status === 200) {
                    try {
                        let userId = await UserController.getUser().id;
                        this.notesArray.push(NotesController.updateNotes(request.data.data, userId));
                    }
                    catch (e) {
                        this.notesArray.push(NotesController.updateNotes(request.data.data, -1));
                    }
                }
            }
        }
    }
}
</script>

<style lang="scss" scoped>
    .rankings {
        .notes {
            display: flex;
            flex-wrap: wrap;
            flex-direction: column;
            gap: 30px;

            .note {
                margin-top: 15px;
            }
        }
    }
</style>
