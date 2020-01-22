<?php
if ($title == "Home") {
    echo "
<script src='assets/bootstrap/js/jquery.min.js'></script>
<script src='assets/bootstrap/js/perfect-scrollbar.jquery.min.js'></script>
<script src='assets/bootstrap/js/popper.min.js'></script>
<script src='assets/bootstrap/js/bootstrap.min.js'></script>


<!--CUSTOM JS-->
<script src='assets/js/script.js'></script>

</body>

</html>
";
} else {
    echo "
<script src='../assets/bootstrap/js/jquery.min.js'></script>
<script src='../assets/bootstrap/js/perfect-scrollbar.jquery.min.js'></script>
<script src='../assets/bootstrap/js/popper.min.js'></script>
<script src='../assets/bootstrap/js/bootstrap.min.js'></script>


<!--CUSTOM JS-->
<script src='../assets/js/script.js'></script>

</body>

</html>
    ";
}


