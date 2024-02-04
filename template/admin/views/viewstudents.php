
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Cursos UPRA</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" type="image/x-icon" href="favicon.png" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" media="screen" href="assets/css/perfect-scrollbar.min.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="assets/css/style.css" />
    <link defer rel="stylesheet" type="text/css" media="screen" href="assets/css/animate.css" />
    <script src="assets/js/perfect-scrollbar.min.js"></script>
    <script defer src="assets/js/popper.min.js"></script>
    <script defer src="assets/js/tippy-bundle.umd.min.js"></script>
    <script defer src="assets/js/sweetalert.min.js"></script>
</head>

<body x-data="main" class="relative overflow-x-hidden font-nunito text-sm font-normal antialiased" :class="[ $store.app.sidebar ? 'toggle-sidebar' : '', $store.app.theme === 'dark' || $store.app.isDarkMode ?  'dark' : '', $store.app.menu, $store.app.layout,$store.app.rtlClass]">

    <?php
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            header("Location: ../../");
            exit();
        }
    ?>

    <!-- sidebar menu overlay -->
    <div x-cloak class="fixed inset-0 z-50 bg-[black]/60 lg:hidden" :class="{'hidden' : !$store.app.sidebar}" @click="$store.app.toggleSidebar()"></div>

    <!-- screen loader -->
    <div class="screen_loader animate__animated fixed inset-0 z-[60] grid place-content-center bg-[#fafafa] dark:bg-[#060818]">
        <svg width="64" height="64" viewBox="0 0 135 135" xmlns="http://www.w3.org/2000/svg" fill="#4361ee">
            <path d="M67.447 58c5.523 0 10-4.477 10-10s-4.477-10-10-10-10 4.477-10 10 4.477 10 10 10zm9.448 9.447c0 5.523 4.477 10 10 10 5.522 0 10-4.477 10-10s-4.478-10-10-10c-5.523 0-10 4.477-10 10zm-9.448 9.448c-5.523 0-10 4.477-10 10 0 5.522 4.477 10 10 10s10-4.478 10-10c0-5.523-4.477-10-10-10zM58 67.447c0-5.523-4.477-10-10-10s-10 4.477-10 10 4.477 10 10 10 10-4.477 10-10z">
                <animateTransform attributeName="transform" type="rotate" from="0 67 67" to="-360 67 67" dur="2.5s" repeatCount="indefinite" />
            </path>
            <path d="M28.19 40.31c6.627 0 12-5.374 12-12 0-6.628-5.373-12-12-12-6.628 0-12 5.372-12 12 0 6.626 5.372 12 12 12zm30.72-19.825c4.686 4.687 12.284 4.687 16.97 0 4.686-4.686 4.686-12.284 0-16.97-4.686-4.687-12.284-4.687-16.97 0-4.687 4.686-4.687 12.284 0 16.97zm35.74 7.705c0 6.627 5.37 12 12 12 6.626 0 12-5.373 12-12 0-6.628-5.374-12-12-12-6.63 0-12 5.372-12 12zm19.822 30.72c-4.686 4.686-4.686 12.284 0 16.97 4.687 4.686 12.285 4.686 16.97 0 4.687-4.686 4.687-12.284 0-16.97-4.685-4.687-12.283-4.687-16.97 0zm-7.704 35.74c-6.627 0-12 5.37-12 12 0 6.626 5.373 12 12 12s12-5.374 12-12c0-6.63-5.373-12-12-12zm-30.72 19.822c-4.686-4.686-12.284-4.686-16.97 0-4.686 4.687-4.686 12.285 0 16.97 4.686 4.687 12.284 4.687 16.97 0 4.687-4.685 4.687-12.283 0-16.97zm-35.74-7.704c0-6.627-5.372-12-12-12-6.626 0-12 5.373-12 12s5.374 12 12 12c6.628 0 12-5.373 12-12zm-19.823-30.72c4.687-4.686 4.687-12.284 0-16.97-4.686-4.686-12.284-4.686-16.97 0-4.687 4.686-4.687 12.284 0 16.97 4.686 4.687 12.284 4.687 16.97 0z">
                <animateTransform attributeName="transform" type="rotate" from="0 67 67" to="360 67 67" dur="8s" repeatCount="indefinite" />
            </path>
        </svg>
    </div>

    <!-- scroll to top button -->
    <div class="fixed bottom-6 z-50 ltr:right-6 rtl:left-6" x-data="scrollToTop">
        <template x-if="showTopButton">
            <button type="button" class="btn btn-outline-primary animate-pulse rounded-full bg-[#fafafa] p-2 dark:bg-[#060818] dark:hover:bg-primary" @click="goToTop">
                <svg width="24" height="24" class="h-4 w-4" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path opacity="0.5" fill-rule="evenodd" clip-rule="evenodd" d="M12 20.75C12.4142 20.75 12.75 20.4142 12.75 20L12.75 10.75L11.25 10.75L11.25 20C11.25 20.4142 11.5858 20.75 12 20.75Z" fill="currentColor" />
                    <path d="M6.00002 10.75C5.69667 10.75 5.4232 10.5673 5.30711 10.287C5.19103 10.0068 5.25519 9.68417 5.46969 9.46967L11.4697 3.46967C11.6103 3.32902 11.8011 3.25 12 3.25C12.1989 3.25 12.3897 3.32902 12.5304 3.46967L18.5304 9.46967C18.7449 9.68417 18.809 10.0068 18.6929 10.287C18.5768 10.5673 18.3034 10.75 18 10.75L6.00002 10.75Z" fill="currentColor" />
                </svg>
            </button>
        </template>
    </div>

    <div class="main-container min-h-screen text-black dark:text-white-dark" :class="[$store.app.navbar]">
        <!-- start sidebar section -->
        <?php include '../views/sidebar.php'; ?>
        <!-- end sidebar section -->

        <div class="main-content flex flex-col min-h-screen">
            <!-- start header section -->
            <?php include '../views/header.php'; ?>
            <!-- end header section -->

            <div class="animate__animated p-6" :class="[$store.app.animation]">
                <!-- start main content section -->
                <div x-data="contacts">
                        <div class="flex flex-wrap items-center justify-between gap-4">
                        <h2 class="text-xl"><?php echo "Informacion del curso: $course_id"; ?></h2>
                            <div class="flex w-full flex-col gap-4 sm:w-auto sm:flex-row sm:items-center sm:gap-3">
                                <div class="flex gap-3">
                                    <div>
                                        
                                        <div class="fixed inset-0 z-[999] hidden overflow-y-auto bg-[black]/60" :class="addContactModal && '!block'">
                                            <div class="flex min-h-screen items-center justify-center px-4" @click.self="addContactModal = false">
                                                <div
                                                    x-show="addContactModal"
                                                    x-transition
                                                    x-transition.duration.300
                                                    class="panel my-8 w-[90%] max-w-lg overflow-hidden rounded-lg border-0 p-0 md:w-full"
                                                >
                                                    <button
                                                        type="button"
                                                        class="absolute top-4 text-white-dark hover:text-dark ltr:right-4 rtl:left-4"
                                                        @click="addContactModal = false"
                                                    >
                                                        <svg
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            width="24px"
                                                            height="24px"
                                                            viewBox="0 0 24 24"
                                                            fill="none"
                                                            stroke="currentColor"
                                                            stroke-width="1.5"
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            class="h-6 w-6"
                                                        >
                                                            <line x1="18" y1="6" x2="6" y2="18"></line>
                                                            <line x1="6" y1="6" x2="18" y2="18"></line>
                                                        </svg>
                                                    </button>
                                                    <h3
                                                        class="bg-[#fbfbfb] py-3 text-lg font-medium ltr:pl-5 ltr:pr-[50px] rtl:pr-5 rtl:pl-[50px] dark:bg-[#121c2c]"
                                                        x-text="params.id ? 'Editar estudiante' : 'Crear estudiante'"
                                                    ></h3>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                               
                            </div>
                        </div>
                        <div class="panel mt-5 overflow-hidden border-0 p-0">
                            <template x-if="displayType === 'list'">
                                <div class="table-responsive">
                                    <table class="table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>Numero de Estudiante</th>
                                                <th>Nombre</th>
                                                <th>Año de estudio</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($enrolledStudents as $student): ?>
                                            <?php
                                                $numero = $student['student_id'];
                                                // Formatear el número en "XXX-XX-XXXX"
                                                $numero_formateado = substr($numero, 0, 3) . '-' . substr($numero, 3, 2) . '-' . substr($numero, 5);
                                            ?>
                                            <tr>
                                                <td><?php echo $numero_formateado; ?></td>
                                                <td><?php echo $student['name'] . ' ' . $student['lastName']; ?></td>
                                                <td><?php echo $student['year_of_study']; ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </template>
                        </div> <br>
                        <!-- paginacion -->
                        <?php
                            $searchTerm = isset($_GET['search']) ? '&search=' . urlencode($_GET['search']) : ''; // Obtén el término de búsqueda si existe
                        ?>    
                <!-- end main content section -->

            </div>
            <button><a href="classesController.php" class="btn btn-danger">Volver</a></button> <br> <br>
            <!-- start footer section -->
            <div class="p-6 pt-0 mt-auto text-center dark:text-white-dark ltr:sm:text-left rtl:sm:text-right">
                © <span id="footer-year">2022</span>. UPRA All rights reserved.
            </div>
            <!-- end footer section -->
        </div>
    </div>

    <script src="assets/js/alpine-collaspe.min.js"></script>
    <script src="assets/js/alpine-persist.min.js"></script>
    <script defer src="assets/js/alpine-ui.min.js"></script>
    <script defer src="assets/js/alpine-focus.min.js"></script>
    <script defer src="assets/js/alpine.min.js"></script>
    <script src="assets/js/custom.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>


    <script>
        document.addEventListener('alpine:init', () => {
            // main section
            Alpine.data('scrollToTop', () => ({
                showTopButton: false,
                init() {
                    window.onscroll = () => {
                        this.scrollFunction();
                    };
                },

                scrollFunction() {
                    if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
                        this.showTopButton = true;
                    } else {
                        this.showTopButton = false;
                    }
                },

                goToTop() {
                    document.body.scrollTop = 0;
                    document.documentElement.scrollTop = 0;
                },
            }));


            // sidebar section
            Alpine.data('sidebar', () => ({
                init() {
                    const selector = document.querySelector('.sidebar ul a[href="' + window.location.pathname + '"]');
                    if (selector) {
                        selector.classList.add('active');
                        const ul = selector.closest('ul.sub-menu');
                        if (ul) {
                            let ele = ul.closest('li.menu').querySelectorAll('.nav-link');
                            if (ele) {
                                ele = ele[0];
                                setTimeout(() => {
                                    ele.click();
                                });
                            }
                        }
                    }
                },
            }));

            // header section
            Alpine.data('header', () => ({
                init() {
                    const selector = document.querySelector('ul.horizontal-menu a[href="' + window.location.pathname + '"]');
                    if (selector) {
                        selector.classList.add('active');
                        const ul = selector.closest('ul.sub-menu');
                        if (ul) {
                            let ele = ul.closest('li.menu').querySelectorAll('.nav-link');
                            if (ele) {
                                ele = ele[0];
                                setTimeout(() => {
                                    ele.classList.add('active');
                                });
                            }
                        }
                    }
                },

                messages: [{
                        id: 1,
                        image: '<span class="grid place-content-center w-9 h-9 rounded-full bg-success-light dark:bg-success text-success dark:text-success-light"><svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg></span>',
                        title: 'Congratulations!',
                        message: 'Your OS has been updated.',
                        time: '1hr',
                    },
                    {
                        id: 2,
                        image: '<span class="grid place-content-center w-9 h-9 rounded-full bg-info-light dark:bg-info text-info dark:text-info-light"><svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg></span>',
                        title: 'Did you know?',
                        message: 'You can switch between artboards.',
                        time: '2hr',
                    },
                    {
                        id: 3,
                        image: '<span class="grid place-content-center w-9 h-9 rounded-full bg-danger-light dark:bg-danger text-danger dark:text-danger-light"><svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></span>',
                        title: 'Something went wrong!',
                        message: 'Send Reposrt',
                        time: '2days',
                    },
                    {
                        id: 4,
                        image: '<span class="grid place-content-center w-9 h-9 rounded-full bg-warning-light dark:bg-warning text-warning dark:text-warning-light"><svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">    <circle cx="12" cy="12" r="10"></circle>    <line x1="12" y1="8" x2="12" y2="12"></line>    <line x1="12" y1="16" x2="12.01" y2="16"></line></svg></span>',
                        title: 'Warning',
                        message: 'Your password strength is low.',
                        time: '5days',
                    },
                ],

                removeMessage(value) {
                    this.messages = this.messages.filter((d) => d.id !== value);
                },
            }));
        });
        // elec script

        const clearCourse = (course, elements, category) => {
            var query = document.getElementById(course).value; /* Value inputted by user */
            var elements = document.getElementsByClassName(elements); /* Get the li elements in the list */
            var myList = document.getElementById(category); /* Var to reference the list */
            var length = (document.getElementsByClassName(element).length); /* # of li elements */
            var checker = 'false'; /* boolean-ish value to determine if value was found */

            myList.querySelectorAll('li').forEach(function(item) {
                if (item.innerHTML.indexOf(query) !== -1)
                    item.remove();
            });
        }

        const clearCourses = (courses) => {
            document.getElementById(courses).innerHTML = "";
        }

        document.addEventListener("alpine:init", () => {
            Alpine.data("collapse", () => ({
                collapse: false,

                collapseSidebar() {
                    this.collapse = !this.collapse;
                },
            }));

            Alpine.data("dropdown", (initialOpenState = false) => ({
                open: initialOpenState,

                toggle() {
                    this.open = !this.open;
                },
            }));
        });

        // document.addEventListener("DOMContentLoaded", () => {
        //     //Necessary to check these buttons exist at moment of loading
        //     // hook up click events for both buttons
        //     //document.querySelector("#images/espresso_info.jpg").addEventListener("click", joinList("espresso"));
        //     //$("#clear_form").addEventListener("click", clearForm);
        //     document.querySelector(".elec").addEventListener("click") => {
        //         document.getElementById("elec").innerHTML = "";
        //     }

        //     // set focus on first text box after the form loads
        //     //$("#email_1").focus();
        // });
    </script>
    <!-- dropdown script -->
    <script>
        document.addEventListener("alpine:init", () => {
            Alpine.data("dropdown", (initialOpenState = false) => ({
                open: initialOpenState,

                toggle() {
                    this.open = !this.open;
                },
            }));

            Alpine.data('app', () => ({
                    showUploadModal: false,
                    formData: {
                        file: null,
                    },
                    openUploadModal() {
                        this.showUploadModal = true;
                    },
                    closeUploadModal() {
                        this.showUploadModal = false;
                    },
                    submitForm() {
                        // Aquí puedes realizar acciones con el archivo seleccionado, como enviarlo a un servidor.
                        // Luego, cierra el modal.
                        if (this.formData.file) {
                            console.log("Archivo seleccionado:", this.formData.file);
                            // Aquí puedes realizar las acciones necesarias con el archivo.
                        } else {
                            console.log("Ningún archivo seleccionado.");
                        }
                        this.showUploadModal = false;
                    },
                }));

            //contacts
            Alpine.data('contacts', () => ({
                    defaultParams: {
                        id: null,
                        nombre_curso: '',
                        code_curso: '',
                        section: '',
                        credits: null,
                        capacity: null,
                    },
                    displayType: 'list',
                    addContactModal: false,
                    params: {
                        id: null,
                        nombre_curso: '',
                        code_curso: '',
                        section: '',
                        credits: null,
                        capacity: null,
                    },
                    filterdContactsList: [],
                    searchUser: '',
                    contactList: [],

                    init() {
                        this.searchContacts();
                    },

                    searchContacts() {
                        this.filterdContactsList = this.contactList.filter((d) => d.nombre_curso.toLowerCase().includes(this.searchUser.toLowerCase()));
                    },

                    editUser(user) {
                        this.params = this.defaultParams;
                        if (user) {
                            this.params = JSON.parse(JSON.stringify(user));
                        }

                        this.addContactModal = true;
                    },

                    saveUser() {
                        if (!this.params.nombre_curso) {
                            this.showMessage('Name is required.', 'error');
                            return true;
                        }
                        if (!this.params.curso) {
                            this.showMessage('Course is required.', 'error');
                            return true;
                        }
                        if (!this.params.code_curso) {
                            this.showMessage('Number is required.', 'error');
                            return true;
                        }

                        if (this.params.id) {
                            //update user
                            let user = this.contactList.find((d) => d.id === this.params.id);
                            user.nombre = this.params.nombre,
                            user.nombre2 = this.params.nombre2,
                            user.apellidoP = this.params.apellidoP,
                            user.apellidoM = this.params.apellidoM,
                            user.email = this.params.email;
                            user.minor = this.params.minor;
                            user.code_curso = this.params.code_curso;
                            user.cohorte = this.params.cohorte;
                            user.credits = 'No realizada';
                            user.priority = 'activo';
                            user.birthday =  this.params.birthday;
                        } else {
                            //add user
                            let maxUserId = this.contactList.length
                                ? this.contactList.reduce((max, character) => (character.id > max ? character.id : max), this.contactList[0].id)
                                : 0;

                            let user = {
                                id: maxUserId + 1,
                                path: 'profile-35.png',
                                nombre: this.params.nombre,
                                nombre2: this.params.nombre2,
                                apellidoP: this.params.apellidoP,
                                apellidoM: this.params.apellidoM,
                                email: this.params.email,
                                minor: this.params.minor,
                                code_curso: this.params.code_curso,
                                cohorte: this.params.cohorte,
                                credits: 'No realizada',
                                priority: 'activo',
                                birthday: this.params.birthday,
                            };
                            this.contactList.splice(0, 0, user);
                            this.searchContacts();
                        }

                        this.showMessage('User has been saved successfully.');
                        this.addContactModal = false;
                    },

                    deleteUser(user) {
                        this.contactList = this.contactList.filter((d) => d.id != user.id);
                        // this.ids = this.ids.filter((d) => d != user.id);
                        this.searchContacts();
                        this.showMessage('User has been deleted successfully.');
                    },

                    setDisplayType(type) {
                        this.displayType = type;
                    },

                    showMessage(msg = '', type = 'success') {
                        const toast = window.Swal.mixin({
                            toast: true,
                            position: 'top',
                            showConfirmButton: false,
                            timer: 3000,
                        });
                        toast.fire({
                            icon: type,
                            title: msg,
                            padding: '10px 20px',
                        });
                    },

                    tabChanged(type) {
                        this.selectedTab = type;
                        this.searchContacts();
                        this.isShowTaskMenu = false;
                    },

                    setPriority(contact, nombre) {
                        let item = this.filterdContactsList.find((d) => d.id === contact.id);
                        item.priority = nombre;
                        this.searchContacts(false);
                    },
                }));
            });
            
            // window.addEventListener('alpine:init', () => {
                
            // });
 
    </script>
</body>

</html> 