<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Formulario de Registro de Interesados</div>
          <div class="card-body">
            <div v-if="successMessage" class="alert alert-success">{{ successMessage }}</div>
            <form @submit.prevent="submitForm">
              <div class="form-group">
                <label for="nombres">Nombres</label>
                <input type="text" v-model="form.nombres" class="form-control" required>
              </div>
              <div class="form-group">
                <label for="apellidos">Apellidos</label>
                <input type="text" v-model="form.apellidos" class="form-control" required>
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" v-model="form.email" class="form-control" required>
              </div>
              <div class="form-group">
                <label for="telefono">Teléfono</label>
                <input type="tel" v-model="form.telefono" class="form-control" required>
              </div>
              <div class="form-group">
                <label for="programa">Programa de Interés</label>
                <select v-model="form.programa" class="form-control" required>
                  <option disabled value="">Seleccione uno</option>
                  <option>Bachillerato</option>
                  <option>Inglés</option>
                  <option>Preicfes</option>
                </select>
              </div>
              <button type="submit" class="btn btn-primary">Enviar Datos</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import axios from 'axios';

export default {
  data() {
    return {
      form: {
        nombres: '',
        apellidos: '',
        email: '',
        telefono: '',
        programa: ''
      },
      successMessage: ''
    };
  },
  methods: {
    submitForm() {
      axios.post('/api/leads', this.form)
        .then(response => {
          this.successMessage = '¡Gracias! Tus datos han sido registrados correctamente.';
          this.form = { nombres: '', apellidos: '', email: '', telefono: '', programa: '' }; // Limpiar formulario
          setTimeout(() => this.successMessage = '', 5000); // Ocultar mensaje después de 5 seg
        })
        .catch(error => {
          console.error('Hubo un error:', error);
          alert('Ocurrió un error al registrar tus datos.');
        });
    }
  }
};
</script>