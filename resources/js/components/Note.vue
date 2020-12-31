<template>
    <div class="note">
        <div class="bar"/>
        <div class="content">
            <div class="description">Dodany <b>{{ writeDate() }}</b> przez <b>{{ note.name }}</b></div>
            <router-link :to="'/uwaga/' + note.id" class="text" v-html="note.content"></router-link>
            <br><br>
            <div class="actions">
                <div :class="!note.liked ? 'action' : 'action-grayed'" @click="handleLike">
                    {{ note.liked ? 'Lubisz to!' : 'Lubię to!' }} ({{ note.likes }})
                </div>
                <div class="delete" v-if="admin" @click="handleDelete">
                    Usuń to!
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import NotesController from '../NotesController'
import axios from "axios";

export default {
    name: "Note",
    props: ['note', 'admin'],
    methods: {
        writeDate() {
            let date = new Date(this.note.created_at);
            return date.toLocaleDateString();
        },
        async handleLike() {
            await NotesController.addLike(this.note.id);
            this.$emit('reloadNotes');
        },
        async handleDelete() {
            await axios.delete('/api/likes/' + this.note.id).then(req => {
                if (req.status === 200) { this.$emit('reloadNotes') }
            }).catch(e => {
                console.log(e)
            })
        }
    }
}
</script>

<style lang="scss" scoped>
    .note {
        display: flex;
        margin-right: 30px;

        .bar {
            background: #F0F0F0;
            width: 6px;
            padding: 10px 0;
            margin-right: 10px;
        }

        .content {
            padding: 10px;

            .description {
                margin-bottom: 15px;
                font-size: 0.9rem;
            }

            .text {
                font-size: 1.3rem;
                margin-bottom: 25px;
                color: black;
                text-decoration: none;
            }

            .actions {
                display: flex;
                flex-wrap: wrap;
                gap: 15px;

                .action {
                    cursor: pointer;
                    border-radius: 6px;
                    background-color: #fdd500;
                    padding: 7px 15px;
                }

                .action-grayed {
                    cursor: pointer;
                    border-radius: 6px;
                    background-color: #cccccc;
                    padding: 7px 15px;
                }

                .delete {
                    cursor: pointer;
                    border-radius: 6px;
                    background-color: #ff2f2f;
                    padding: 7px 15px;
                    color: white;
                }
            }
        }
    }

</style>
