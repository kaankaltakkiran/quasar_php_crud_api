import { defineStore } from 'pinia'
import { api } from 'src/boot/axios'

export interface User {
  id: number
  name: string
  email: string
}

export const useUserStore = defineStore('user', {
  state: () => ({
    users: [] as User[],
    loading: false,
    error: null as string | null,
  }),

  actions: {
    async fetchUsers() {
      this.loading = true
      try {
        const response = await api.get('http://localhost/quasar_crud_api/users.php')
        this.users = response.data
        this.error = null
      } catch (err) {
        this.error = 'Failed to fetch users'
        console.error(err)
      } finally {
        this.loading = false
      }
    },

    async createUser(userData: { name: string; email: string; password: string }) {
      this.loading = true
      try {
        const response = await api.post('/users.php', userData)
        await this.fetchUsers()
        return response.data
      } catch (err) {
        this.error = 'Failed to create user'
        console.error(err)
        throw err
      } finally {
        this.loading = false
      }
    },

    async updateUser(userData: { id: number; name: string; email: string }) {
      this.loading = true
      try {
        const response = await api.put('/users.php', userData)
        await this.fetchUsers()
        return response.data
      } catch (err) {
        this.error = 'Failed to update user'
        console.error(err)
        throw err
      } finally {
        this.loading = false
      }
    },

    async deleteUser(id: number) {
      this.loading = true
      try {
        const response = await api.delete(`/users.php?id=${id}`)
        await this.fetchUsers()
        return response.data
      } catch (err) {
        this.error = 'Failed to delete user'
        console.error(err)
        throw err
      } finally {
        this.loading = false
      }
    },
  },
})
