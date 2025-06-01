<template>
  <q-page class="q-pa-md">
    <div class="row q-mb-md">
      <div class="col">
        <h4 class="q-mt-none q-mb-md">User Management</h4>
      </div>
      <div class="col-auto">
        <q-btn color="primary" @click="openDialog()" label="Add User" />
      </div>
    </div>

    <q-table :rows="userStore.users" :columns="columns" row-key="id" :loading="userStore.loading">
      <template v-slot:body-cell-actions="props">
        <q-td :props="props">
          <q-btn-group flat>
            <q-btn flat round color="primary" icon="edit" @click="openDialog(props.row)" />
            <q-btn flat round color="negative" icon="delete" @click="confirmDelete(props.row)" />
          </q-btn-group>
        </q-td>
      </template>
    </q-table>

    <q-dialog v-model="dialog" persistent>
      <q-card style="min-width: 350px">
        <q-card-section>
          <div class="text-h6">{{ isEdit ? 'Edit User' : 'Add User' }}</div>
        </q-card-section>

        <q-card-section class="q-pt-none">
          <q-input
            v-model="form.name"
            label="Name"
            :rules="[(val) => !!val || 'Name is required']"
          />
          <q-input
            v-model="form.email"
            label="Email"
            type="email"
            :rules="[
              (val) => !!val || 'Email is required',
              (val) => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(val) || 'Invalid email format',
            ]"
          />
          <q-input
            v-if="!isEdit"
            v-model="form.password"
            label="Password"
            type="password"
            :rules="[(val) => !!val || 'Password is required']"
          />
        </q-card-section>

        <q-card-actions align="right">
          <q-btn flat label="Cancel" color="primary" v-close-popup />
          <q-btn flat label="Save" color="primary" @click="saveUser" />
        </q-card-actions>
      </q-card>
    </q-dialog>
  </q-page>
</template>

<script setup lang="ts">
import { ref, onMounted } from 'vue'
import { useQuasar } from 'quasar'
import { useUserStore, type User } from 'src/stores/user-store'

const $q = useQuasar()
const userStore = useUserStore()

const columns = [
  { name: 'id', label: 'ID', field: 'id', align: 'left' as const },
  { name: 'name', label: 'Name', field: 'name', align: 'left' as const },
  { name: 'email', label: 'Email', field: 'email', align: 'left' as const },
  { name: 'actions', label: 'Actions', field: 'actions', align: 'center' as const },
]

const dialog = ref(false)
const isEdit = ref(false)
const form = ref({
  id: 0,
  name: '',
  email: '',
  password: '',
})

onMounted(() => {
  userStore.fetchUsers()
})

function openDialog(user?: User) {
  if (user) {
    isEdit.value = true
    form.value = { ...user, password: '' }
  } else {
    isEdit.value = false
    form.value = { id: 0, name: '', email: '', password: '' }
  }
  dialog.value = true
}

async function saveUser() {
  try {
    if (isEdit.value) {
      await userStore.updateUser({
        id: form.value.id,
        name: form.value.name,
        email: form.value.email,
      })
    } else {
      await userStore.createUser({
        name: form.value.name,
        email: form.value.email,
        password: form.value.password,
      })
    }
    dialog.value = false
    $q.notify({
      color: 'positive',
      message: `User ${isEdit.value ? 'updated' : 'created'} successfully`,
    })
  } catch (err) {
    console.error('Error saving user:', err)
    $q.notify({
      color: 'negative',
      message: `Failed to ${isEdit.value ? 'update' : 'create'} user`,
    })
  }
}

function confirmDelete(user: User) {
  $q.dialog({
    title: 'Confirm',
    message: `Are you sure you want to delete ${user.name}?`,
    cancel: true,
    persistent: true,
  }).onOk(async () => {
    try {
      await userStore.deleteUser(user.id)
      $q.notify({
        color: 'positive',
        message: 'User deleted successfully',
      })
    } catch (err) {
      console.error('Error deleting user:', err)
      $q.notify({
        color: 'negative',
        message: 'Failed to delete user',
      })
    }
  })
}
</script>
