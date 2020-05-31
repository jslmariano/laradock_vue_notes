import axios from 'axios'
import * as types from '../mutation-types'

console.log('hey');


// state
export const state = {
    notes: null,
    current_note: null
}

// getters
export const getters = {
  notes: state => state.notes,
  current_note: state => state.current_note,
}

// mutations
export const mutations = {
}

// actions
export const actions = {
    redirectTo({ commit }, vue_context, route_name) {
        vue_context.$router.push({ name: route_name })
    },
    async fetchNotes ({ commit }) {
        try {
            const { data } = await axios.get('/api/notes')
            state.notes = data
            console.log(data);

        } catch (e) {
            state.notes = null;
        }
    },
    async fetchSingleNote ({ commit }, id) {
        try {
            const { data } = await axios.get(`/api/note/${id}`)
            state.current_note = data
            console.log(data);
        } catch (e) {
            state.current_note = null;
        }
    },
    async deleteNote ({ commit }, id) {
        try {
            await axios.delete(`/api/note/delete/${id}`)
            let clone = state.notes.filter(obj => obj.id !== id)
            state.notes = clone
        } catch (e) {
            console.log("Something wrong with deleting note, but it's ok", e);
        }
    },
    createNote ({ commit }, note) {
        try {
            const { data } = axios.post('/api/note/store', note)
        } catch (e) {
            console.log("Something wrong with creating note, but it's ok", e);
        }
    },
    async updateNote ({ commit }, id, note) {
        try {
            const { data } = await axios.put(`/api/note/update/${id}`, note)
        } catch (e) {
            console.log("Something wrong with updating note, but it's ok", e);
        }
    }
}
