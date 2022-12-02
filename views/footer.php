
<footer>
    
    <div class="pie1">
        <div class="redes-sociales">
            <h3>Síganos</h3>
            <a href="https://www.facebook.com/0203Idara/" target="_blank"><i class="fa-brands fa-facebook"></i></a>
            <a href="" target="_blank"><i class="fa-brands fa-twitter"></i></a>
            <a href="" target="_blank"><i class="fa-brands fa-instagram"></i></a>
            <a href="" target="_blank"><i class="fa-brands fa-youtube"></i></a>
        </div>
        <div class="novedades">
            <h3>Recibe novedades</h3>
            <input type="email" name="contacto" placeholder="Ingrese su correo">
        </div>
    </div>

    <div class="pie2">
        <a href="#">Features</a> 
        <a href="#">About</a>
        <a href="#">Testimonials</a>
        <a href="#">Contact</a>
        <a href="#">Download</a>
    </div>

    <div class="pie3">
        <h3>3241 Lima, Los Olivos, CA 94103, PERÚ</h3>
    </div>

    <div class="pie4">
        <h3>&copy; Grupo 4 UTP. Todos los derechos reservados.</h3>
    </div>

    
</footer>

    <!-- enlace al archivo js -->
    <script src="../assets/js/script.js"></script>
    <script src="../assets/js/detalleProducto.js"></script>
    <script src="../assets/js/tipoLunaCambioPant.js"></script>
    <script src="../assets/js/carritoPantallas.js"></script>
    <script src="../assets/js/anadirCarrito.js"></script>
    <script src="../assets/js/actualizarCarrito.js"></script>
    <script src="../assets/js/eliminarCarrito.js"></script>    

    <script src="../assets/js-bootstrap/bootstrap.js"></script>
    <script src="../assets/js-bootstrap/bootstrap.min.js"></script>


    <script src="https://kit.fontawesome.com/a4c228978d.js" crossorigin="anonymous"></script>

    <script>
        function mostrar(valor){
        document.getElementById("resultadoMsg").innerHTML = valor;
        }
        
    </script>

    <!-- Disminuir o aumentar productos -->
    <script>
        function actualizarCantidad(cantidad, id){
        let url = "../model/actualizarCarr.php"
        let formData = new FormData()
        formData.append('action', 'agregar')
        formData.append('id', id)
        formData.append('cantidad', cantidad)

        fetch(url, {
            method: 'POST',
            body: formData,
            mode: 'cors'
        }).then(response => response.json())
        .then(data => {
            if(data.ok){

                let divsubtotal = document.getElementById('subtotal_'+ id)
                divsubtotal.innerHTML = data.sub

                let total = 0.00
                let list = document.getElementsByName('subtotal[]')

                for(let i=0; i< list.length; i++){
                    total += parseFloat(list[i].innerHTML.replace(/[S/,]/g, ''))
                }

                total = new Intl.NumberFormat('en-US', {
                    minimumFractionDigits: 2
                }).format(total)
                document.getElementById('total').innerHTML = '<?php echo MONEDA; ?>' + total;
            }
        })
    }

    function eliminar(){

        let botonElimina = document.getElementById('btn-elimina')
        let id = botonElimina.value 

        let url = "../model/actualizarCarr.php"
        let formData = new FormData()
        formData.append('action', 'eliminar')
        formData.append('id', id)

        fetch(url, {
            method: 'POST',
            body: formData,
            mode: 'cors'
        }).then(response => response.json())
        .then(data => {
            if(data.ok){
                location.reload()
            }
        })
    }
    </script> 
</body>
</html>