import axios from 'axios';

export default class NotesController {
    static async addLike(note_id) {
        await axios.put('/api/likes/add', { note_id }).then(req => { console.log(req); }).catch(e => { console.log(e); });
    }

    static updateNotes(notes, userId) {
        notes.forEach(note => { if(note.creator_id === userId) note.liked = true; });
        return notes;
    }
}
