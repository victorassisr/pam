				<div class="container">
					<table class="table table-responsive-sm table-hover table-white">
						<thead>
							<tr class="text-center table-doador">
								<th colspan="2"> Doador - {{doador.nome}}</th>
							</tr>
						</thead>
						<tr>
							<th scope="row" colspan="2" class="table-dark">Dados Pessoais</th>
						</tr>
						<tr>
							<td><b>Endereço:</b> {{doador.endereco}}</td>
							<td><b>Data de Nascimento:</b> {{doador.nascimento | date:'dd/MM/yyyy'}}</td>
						</tr>
						<tr>
							<td><b>Documento:</b> {{doador.documento}}</td>
							<td><b>Pessoa {{doador.tipoPessoa}}</b></td>
						</tr>
						<tr>
							<td><b>Celular:</b> {{doador.celular1}}</td>
							<td><b>Celular:</b> {{doador.celular2}}</td>
						</tr>
						<tr>
							<td><b>Tel. Residencial:</b> {{doador.telefoneResidencial}}</td>
							<td><b>E-mail:</b> {{doador.email}}</td>
						</tr>
						<tr>
							<th scope="row" colspan="2" class="table-dark">Dados Cadastrais</th>
						</tr>
						<tr>
							<td><b>Data de Cadastro: </b> {{doador.dataCadastro | date:'dd/MM/yyyy'}}</td>
							<td><b>Doador {{doador.tipoDoador}}</b></td>
						</tr>
						<tr>
							<td><b>Doa todo dia: </b> {{doador.doaDia}}</td>
							<td><b>Doa todo mês:</b>  {{doador.doaMes}}</td>
						</tr>
						<tr>
							<td colspan="2"><b>Valor a ser doado: </b>R$ {{doador.reaisADoar}},{{doador.centavosADoar}}</td>
						</tr>
					</table>
				</div>