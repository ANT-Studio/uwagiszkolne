import axios from 'axios';

export default class NotesController {
    static async getLikes(noteId) {
        let response = await axios.get("/api/likes/index");
        console.log(response.data.data);
        return response.data.data.filter(like => like.note_id === noteId).length;
    }

    static async addLike(note_id) {
        console.log(note_id);
        await axios.put('/api/likes/add', { note_id }).then(req => {
         console.log(req);
        }).catch(e => {
            console.log(e);
        });
    }
}
