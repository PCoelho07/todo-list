<template>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<div class="row">
							<div class="col-md-8">
								<h4>Minhas tarefas</h4>
							</div>
							<div class="col-md-4">
								<button @click="createTask()" class="btn btn-primary pull-right">+ Adicionar tarefa</button>
							</div>
						</div>
					</div>
					<div class="panel-body">
						<table class="table table-hover table-striped">
						  <thead>
						    <tr>
						      <th scope="col">#</th>
						      <th scope="col">Descrição da tarefa</th>
						      <th scope="col">Data de criação</th>
						      <th scope="col">Tipo da tarefa</th>
						      
						    </tr>
						  </thead>
						  <tbody>
						  	<template v-for="task in tasks">
							    <tr>
							      <td>
							      	<div v-if="!task.done">
								      	<button class="btn btn-success btn-xs" @click="setTaskDone(task.id)">
								      		<i class="fa fa-check-square" aria-hidden="true"></i>
								      	</button>
								      	<button class="btn btn-danger btn-xs">
								      		<i class="fa fa-times-circle" aria-hidden="true"></i>
								      	</button>
							      	</div>
							      	<div class="label label-success" v-if="task.done">
							      		<i class="fa fa-smile-o" aria-hidden="true"></i>
							      	</div>
							      </td>
							      <td :style="styleDataByStatus(task.done)">{{ task.nome }}</td>
							      <td :style="styleDataByStatus(task.done)">{{ dateFormat(task.created_at) }}</td>
							      <td :style="styleDataByStatus(task.done)">
							      		<span class="label" v-bind:class="classLabelType(task.tipo.slug)">
							      			{{ task.tipo.nome }}
							      		</span>
							      </td>
							    </tr>
						  	</template>
						  </tbody>
						</table>			
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		data() {
			return {
				tasks: []
			}
		},
		computed: {

		},

		mounted(){
			this.init();
		},
		methods: {
			init: function() {
				this.getAllTaks();
			},

			getAllTaks: function() {
				var self = this;
				axios.get('api/task')
						.then(function (response){
							console.log(response.data);
							self.tasks = response.data['results'];
						});
			},

			createTask: function() {
				var self = this;

				var tipos = [1,2,3];

				var data = {
					nome: 'Comprar papel higiênico',
					tipo_id: Math.random()*10 % 3
				};

				axios.post('api/task', data)	
						.then(function (response){
							console.log(response.data['results']);
							self.tasks = response.data['results'];
						});
			},

			setTaskDone: function() {

			},

			dateFormat: function(date) {
				   return moment(date, 'YYYY-MM-DD').format('DD/MM/YYYY');
			},

			styleDataByStatus: function(isDone) {
				if(isDone){
					return {
						'text-decoration': 'line-through'
					}
				}

			},

			classLabelType: function(slug) {
				return {
					'label-danger': slug === 'urg',
					'label-warning': slug === 'imp',
					'label-info': slug === 'norm'
				}
			}
		}


	}	
</script>
