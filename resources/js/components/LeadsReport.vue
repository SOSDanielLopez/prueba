<template>
  <div class="container">
    <h2>Reporte de Leads Registrados</h2>
    <div class="mb-3">
      <input type="text" v-model="search" class="form-control" placeholder="Buscar por nombre, email, programa...">
    </div>
    <div class="table-responsive">
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Nombre Completo</th>
            <th>Email</th>
            <th>Teléfono</th>
            <th>Programa</th>
            <th>Estado</th>
            <th>Acción</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="lead in leads" :key="lead.id">
            <td>{{ lead.nombres }} {{ lead.apellidos }}</td>
            <td>{{ lead.email }}</td>
            <td>{{ lead.telefono }}</td>
            <td>{{ lead.programa }}</td>
            <td>
              <span :class="lead.contactado ? 'badge badge-success' : 'badge badge-warning'">
                {{ lead.contactado ? 'Contactado' : 'No llamado' }}
              </span>
            </td>
            <td>
              <button v-if="!lead.contactado" @click="markAsContacted(lead)" class="btn btn-sm btn-info">
                Marcar Contactado
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>
<script>
import axios from 'axios';
import _ from 'lodash'; // Para el debounce

export default {
  data() {
    return {
      leads: [],
      search: ''
    };
  },
  watch: {
    // Usamos watch y debounce para no hacer una petición en cada tecleo
    search: _.debounce(function(newVal) {
      this.fetchLeads();
    }, 500)
  },
  methods: {
    fetchLeads() {
      axios.get('/api/leads', { params: { search: this.search } })
        .then(response => {
          this.leads = response.data;
        })
        .catch(error => console.error(error));
    },
    markAsContacted(lead) {
      axios.patch(`/api/leads/${lead.id}/contacted`)
        .then(response => {
          // Actualizamos el estado localmente para que la UI reaccione al instante
          let index = this.leads.findIndex(item => item.id === lead.id);
          if (index !== -1) {
            this.leads[index].contactado = true;
          }
        })
        .catch(error => console.error(error));
    }
  },
  created() {
    this.fetchLeads();
  }
};
</script>