import axios from 'axios';

export default class NotesController {
    static async getLikes(noteId) {
        let response = await axios.get("/api/likes/index");
        response.data.data.filter(like => like.note_id === noteId);
        return response.data.data.length;
    }

    static async addLike(note_id) {
        await axios.put('/api/likes/add', { note_id });
    }
}
