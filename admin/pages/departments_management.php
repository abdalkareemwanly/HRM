<?php
ob_start();
$page_title = "ادارة الأقسام";
include "../includes/header.php";
session_start();
if (isset($_SESSION['id']) and $_SESSION['status'] == 1) {

    $section = isset($_GET['section']) ? $_GET['section'] : "home";

    if ($section == "home") {
        require '../../connect.php';

        $sql = "SELECT * FROM departments";
        $result = mysqli_query($conn, $sql);
        ?>

        <div class="p-4">
            <div>
                <a class="btn btn-success" href="?section=add">اضافة قسم جديد</a>
            </div>

            <div class="grid grid-cols-1  sm:grid-cols-3 gap-4 my-4">
                <?php
                if (mysqli_num_rows($result) > 0) {
                    ?>
                    <?php

                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <div
                            class="flex flex-col items-center rounded-md shadow-md justify-center h-[250px] gap-12 bg-secondColor text-white">
                            <h4 class="title-text"><?php echo $row['name'] ?></h4>
                            <div>
                                <a href="dep_categories_management.php?id=<?php echo $row['id'] ?>" class="btn btn-primary">عرض</a>
                                <a href="?section=edit&&id=<?php echo $row['id'] ?>" class="btn btn-warning">تعديل</a>
                                <a href="?section=destroy&&id=<?php echo $row['id'] ?>" class="btn btn-danger deleteBtn">حذف</a>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <?php
                }
                ?>
        </div>
        <script>
            // Select all elements with the deleteBtn class
            const deleteBtns = document.querySelectorAll('.deleteBtn');

            // Add click event listener to each delete button
            deleteBtns.forEach(function (deleteBtn) {
                deleteBtn.addEventListener('click', function (event) {
                    event.preventDefault(); // Prevent the default action (e.g., navigating to the link)

                    // Show SweetAlert confirmation dialog
                    Swal.fire({
                        title: 'هل أنت متأكد؟',
                        text: "لن تتمكن من استعادة هذا العنصر بعد الحذف!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'نعم، احذفه!',
                        cancelButtonText: 'إلغاء',
                        theme: 'dark'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire({
                                title: "اتمام العملية!",
                                text: "تم الحذف بنجاح.",
                                icon: "success"
                            }).then((res) => {
                                if (result.isConfirmed) {
                                    // If confirmed, proceed with the deletion by navigating to the delete URL
                                    window.location.href = deleteBtn.href;
                                }
                            })
                        }

                    });
                });
            });
        </script>
        <?php
    } elseif ($section == "add") {
        if (isset($_POST['send'])) {

            $name = $_POST['name'];


            if (!empty($name)) {
                require '../../connect.php';

                $sql = "INSERT INTO departments(name) VALUES ('$name')";

                if (mysqli_query($conn, $sql)) {
                    ?>
                    <div class="my-container" style="margin: 16px 0;">
                        <div class="alert alert-success" role="alert">
                            تم الاضافة بنجاح
                        </div>
                    </div>
                    <?php
                    header("refresh:2;url=departments_management.php");
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }

                mysqli_close($conn);
            }

        }

        ?>

        <div class="my-container">
            <div class="d-flex w-100 mt-4 justify-content-between align-items-center">
                <h4 class="title-text">انشاء قسم جديد</h4>
            </div>
            <form action="?section=add" method="post" enctype="multipart/form-data" style="width: 100%; max-width: 450px;"
                class="mt-3 flex flex-column gap-4">
                <div class="flex flex-col gap-2">
                    <label for="name">اسم القسم</label>
                    <input type="text" name="name" id="name" class=" input" id="exampleFormControlTextarea1" rows="3"
                        required />
                </div>
                <button type="submit" class="btn btn-success w-fit" name="send">اضافة</button>
            </form>
        </div>

        <?php
    } elseif ($section == "edit") {
        $id = intval($_GET['id']);

        require '../../connect.php';

        $sql = "SELECT * FROM departments WHERE id = '$id'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        mysqli_close($conn);

        if (isset($_POST['send'])) {

            $name = $_POST['name'];

            if (!empty($name)) {
                require '../../connect.php';

                $sql = "UPDATE departments SET name = '$name' WHERE id = '$id'";

                if (mysqli_query($conn, $sql)) {
                    ?>
                    <div class="my-container  p-4" style="margin: 16px 0;">
                        <div class="alert alert-success" role="alert">
                            تم التعديل بنجاح
                        </div>
                    </div>
                    <?php

                    header("refresh:2;url=departments_management.php");
                } else {
                    echo "Error updating record: " . mysqli_error($conn);
                }

                mysqli_close($conn);
            }
        }
        ?>
        <div class="my-container  p-4">
            <div class="d-flex w-100 mt-4 justify-content-between align-items-center">
                <h4 class="title-text">تعديل بيانات القسم</h4>
            </div>
            <form action="?section=edit&&id=<?php echo $id ?>" method="post" enctype="multipart/form-data"
                style="width: 100%; max-width: 450px;" class="mt-3 flex flex-column gap-4">
                <div class="form-group">
                    <label for="name">محتوى المنشور</label>
                    <input type="text" name="name" id="name" class=" input" id="exampleFormControlTextarea1" rows="3" required
                        value=" <?php echo $row['name'] ?>" />
                </div>
                <button type="submit" class="btn btn-success w-fit" name="send">تعديل</button>
            </form>
        </div>

        <?php
    } elseif ($section == "destroy") {
        $id = intval($_GET['id']);

        require '../../connect.php';
        $sql = "SELECT * FROM departments WHERE id = '$id'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        mysqli_close($conn);

        require '../../connect.php';

        $sql = "DELETE FROM departments WHERE id = '$id'";

        if (mysqli_query($conn, $sql)) {
            ?>
            <div class="my-container  p-4" style="margin: 16px 0;">
                <div class="alert alert-success" role="alert">
                    تم الحذف بنجاح
                </div>
            </div>
            <?php

            header("refresh:2;url=departments_management.php");
        } else {
            echo "Error deleting record: " . mysqli_error($conn);
        }

        mysqli_close($conn);
    }
} else {
    ?>
    <div class="my-container" style="margin: 16px 0;">
        <div class="alert alert-danger" role="alert">
            دخول غير مسموح به
        </div>
    </div>
    <?php
}
ob_end_flush();
?>


<?php include "../includes/footer.php" ?>