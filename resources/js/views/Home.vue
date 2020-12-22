<template>
    <div class="home">
        <h1>Najnowsze uwagi!</h1>
        <div class="notes">
            <note v-for="note in notes" :key="note.content" :note="note"></note>
        </div>
    </div>
</template>

<script>
import Note from "../components/Note";
import axios from "axios";
export default {
    name: "Home",
    components: { Note },
    data() {
        return {
            notes: []
        }
    },
    mounted() {
        axios.get("/api/note/index").then(request => {
            if(request.status === 200) { this.notes = request.data.data; }
        });
    }
}
</script>

<style lang="scss" scoped>
    .home {
        .notes {
            display: flex;
            flex-wrap: wrap;

            .note {
                width: 50%;
                margin-bottom: 20px;
            }
        }
    }
</style>
