import axios from 'axios';

export default class NotesController {
    static async addLike(note_id) {
        await axios.put('/api/likes/add', { note_id }).catch(e => { console.log(e); });
    }

    static updateNotes(notes, userId) {
        notes.forEach(note => { if(note.creator_id === userId) note.liked = true; });
        return notes;
    }

    static async fetchUserNotes() {
        let notes = await axios.get('/api/note/own');
        return notes.data.data;
    }

    static async getNote(id) {
        let response = await axios.get('/api/note/' + id);
        return response.data.note[0];
    }
}
