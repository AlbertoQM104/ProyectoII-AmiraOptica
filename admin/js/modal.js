$(document).ready(function () {
    let productos = [];
    let items = {
        id: 0
    }
    mostrar();
    $('.navbar-nav .nav-link[category="all"]').addClass('active');

    $('.nav-link').click(function () {
        let productos = $(this).attr('category');

        $('.nav-link').removeClass('active');
        $(this).addClass('active');

        $('.productos').css('transform', 'scale(0)');

        function ocultar() {
            $('.productos').hide();
        }
        setTimeout(ocultar, 400);

        function mostrar() {
            $('.productos[category="' + productos + '"]').show();
            $('.productos[category="' + productos + '"]').css('transform', 'scale(1)');
        }
        setTimeout(mostrar, 400);
    });

    $('.nav-link[category="all"]').click(function () {
        function mostrarTodo() {
            $('.productos').show();
            $('.productos').css('transform', 'scale(1)');
        }
        setTimeout(mostrarTodo, 400);
    });

    $('.agregar').click( function(e){
        e.preventDefault();
        const id = $(this).data('id');
        items = {
            id: id
        }
        productos.push(items);
        localStorage.setItem('productos', JSON.stringify(productos));
        mostrar();
    })
    $('#btnCarrito').click(function(e){
        $('#btnCarrito').attr('href','carrito.php');
    })
    $('#btnVaciar').click(function(){
        localStorage.removeItem("productos");
        $('#tblCarrito').html('');
        $('#total_pagar').text('0.00');
    })
    //categoria
    $('#abrirCategoria').click(function(){
        $('#categorias').modal('show');
    })
    //añadir producto
    $('#abrirProducto').click(function () {
        $('#productos').modal('show');
    })

    //añadir empleado
    $('#abrirEmpleado').click(function () {
        $('#empleados').modal('show');
    })

    //Editar producto
    /* $('#editarProducto').click(function() {
        $('#editarProds').modal('show');
    }) */

    /* Editar producto 2 */
    /* $('.editabtn').on('click', function(){

        $tr=$(this).closest('tr');
        var datos = $tr.children("td").map(function(){
            return $(this).text();
        });
        $('#update_id').val(datos[0]);
        $('#nombre').val(datos[1]);
        $('#descripcion').val(datos[2]);
        $('#precio').val(datos[3]);
        $('#stock').val(datos[4]);
        $('#id_categoria').val(datos[5]);

    }); */

    //Eliminar producto
    /* $('.eliminar').click(function(e){
        e.preventDefault();
        if (confirm('Esta seguro de eliminar?')) {
            this.submit();
        }
    }) */
});

function mostrar(){
    if (localStorage.getItem("productos") != null) {
        let array = JSON.parse(localStorage.getItem('productos'));
        if (array) {
            $('#carrito').text(array.length);
        }
    }
}