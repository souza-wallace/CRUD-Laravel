$(document).ready(function(){
    $('.delete').click(function(){
        var id = $(this).data('id');
        var form = $('#deleteForm');
        var action = form.attr('action');
        var newAction = action.replace('__ID__', id);
        form.attr('action', newAction);
    });

    $('.edit').click(function(){
        const client = $(this).data('client');
        console.log(client)
        const id = $(this).data('id');
        const form = $('#editForm');

        $('#name').val(client.name);
        $('#email').val(client.email);
        $('#cpf').val(client.cpf);

        var date = new Date(client.date_born);
        var formattedDate = date.toISOString().split('T')[0];
        $('#date_born').val(formattedDate);

        if (client.address && client.address.street) {
            $('#street').val(client.address.street);
        } else {
            $('#street').val('');
        }
        
        if (client.address && client.address.number) {
            $('#number').val(client.address.number);
        } else {
            $('#number').val('');
        }
        
        if (client.address && client.address.cep) {
            $('#cep').val(client.address.cep);
        } else {
            $('#cep').val('');
        }
        
        if (client.address && client.address.city) {
            $('#city').val(client.address.city);
        } else {
            $('#city').val('');
        }
        
        if (client.address && client.address.state) {
            $('#state').val(client.address.state);
        } else {
            $('#state').val('');
        }
        

        var action = form.data('edit-action');
        var newAction = action.replace('__ID__', id);
        form.attr('action', newAction);
    
        // Abre o modal
        $('#editClientModal').modal('show');
    });

    $('.close').click(function(){
        $('#editClientModal').find('input[type=text], input[type=email], input[type=date], input[type=number]').val('');
    });

	$('[data-toggle="tooltip"]').tooltip();
	
	var checkbox = $('table tbody input[type="checkbox"]');
	$("#selectAll").click(function(){
		if(this.checked){
			checkbox.each(function(){
				this.checked = true;                        
			});
		} else{
			checkbox.each(function(){
				this.checked = false;                        
			});
		} 
	});
	checkbox.click(function(){
		if(!this.checked){
			$("#selectAll").prop("checked", false);
		}
	});

    $('#search').click(function(){
        const input = $('#inputSearch').val();
        console.log(input, 'inp')

        $.ajax({
            url: '/filter',
            type: 'GET',
            data: { text: input },
            success: function(response) {
                $('body').html(response);
            },
            error: function(xhr, status, error) {
              console.error('Erro ao obter clientes: ' + error);
            }
        });
    });

    $('#clear').click(function(){
        $.ajax({
            url: '/clients',
            type: 'GET',
            success: function(response) {
                $('body').html(response);
            },
            error: function(xhr, status, error) {
              console.error('Erro ao obter clientes: ' + error);
            }
        });
    });
});