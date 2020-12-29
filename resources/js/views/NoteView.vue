<template>
    <div class="note-view">
        <h1>Uwaga #{{ $route.params.id }}</h1>
        <span class="content">{{ note.content }}</span>
        <br><br><br><br>
        <div class="actions">
            <div :class="!note.liked ? 'action' : 'action-grayed'" @click="handleLike">
                {{ note.liked ? 'Lubisz to!' : 'Lubię to!' }} ({{ note.likes }})
            </div>
            <div class="delete" v-if="admin" @click="handleDelete">
                Usuń to!
            </div>
        </div>
        <br><br><br><br>
        <h2>Komentarze</h2>
        <div class="comments">
            <div id="disqus_thread"></div>
        </div>
    </div>
</template>

<script>
import NotesController from '../NotesController'
import UserController from '../UserController'

export default {
    name: "NoteView",
    data() {
        return {
            note: { },
            admin: false
        }
    },
    async mounted() {
        this.note = await NotesController.getNote(this.$route.params.id);
        if(this.note === null) await this.$router.push('/');
        this.admin = await UserController.admin();

        (function() { // DON'T EDIT BELOW THIS LINE
            var d = document, s = d.createElement('script');
            s.src = 'https://uwagiszkolne.disqus.com/embed.js';
            s.setAttribute('data-timestamp', +new Date());
            (d.head || d.body).appendChild(s);
        })();
    }
}
</script>

<style lang="scss" scoped>
    .note-view {
        .content {
            font-size: 1.5rem;
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

        .comments {
            margin: 30px 0;
        }
    }
</style>
