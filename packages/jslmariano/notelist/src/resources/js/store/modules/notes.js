import axios from 'axios'
import * as types from '../mutation-types'
// import routes from '~/router'

console.log('hey');


// state
export const state = {
    notes: null
}

// getters
export const getters = {
  notes: state => state.notes,
}

// mutations
export const mutations = {
}

// actions
export const actions = {
    async fetchNotes ({ commit }) {
        try {
            const { data } = await axios.get('/api/notes')
            state.notes = { notes: data }
        } catch (e) {
            state.notes = null;
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
    }
}
