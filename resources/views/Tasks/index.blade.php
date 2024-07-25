<x-app-layout>
    <x-slot name="header">



        <div class="flex justify-between ">

            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Tasks') }}
            </h2>


            <form class="form-inline right-0">
                <div class="flex">
                    <div class="col-auto pt-2 dark:text-gray-200">Sort by &nbsp;</div>
                    <div class="col-auto">
                        <select class="form-select dark:text-gray-200  dark:bg-gray-800" onchange="sort_by(this.value)">
                            <option value="latest"
                                {{ (Request::query('sort_by') && Request::query('sort_by') == 'latest') || !Request::query('sort_by') ? 'selected' : '' }}>
                                Latest</option>
                            <option value="oldest"
                                {{ Request::query('sort_by') && Request::query('sort_by') == 'oldest' ? 'selected' : '' }}>
                                Oldest</option>
                        </select>
                    </div>
                </div>


            </form>
            <form class="form-inline right-0">
                <div class="flex">
                    <div class="col-auto pt-2 dark:text-gray-200">Filter by Category &nbsp;</div>
                    <div class="col-auto">
                        <select class="form-select dark:text-gray-200  dark:bg-gray-800" onchange="sort_by(this.value)">
                            <option><a href="javascript:filter_tasks('')"
                                    class="list-group-item list-group-item-action {{ !Request::query('category') ? 'active' : '' }}">All</a>
                            </option>
                            <option><a href="javascript:filter_tasks('Urgent')"
                                    class="list-group-item list-group-item-action {{ Request::query('category') == 'Urgent' ? 'active' : '' }}">Urgent</a>
                            </option>
                            <option><a href="javascript:filter_tasks('Personal')"
                                    class="list-group-item list-group-item-action {{ Request::query('category') == 'Personal' ? 'active' : '' }}">Personal</a>
                            </option>
                            <option> <a href="javascript:filter_tasks('Work')"
                                    class="list-group-item list-group-item-action {{ Request::query('category') == 'Work' ? 'active' : '' }}">Work</a>
                            </option>

                        </select>
                    </div>
                </div>


            </form>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <div class="grid grid-cols-1 md:grid-cols-3">

                        <div>

                            @if ($errors->any())
                                @foreach ($errors->all() as $error)
                                    {{ $error }}
                                @endforeach
                            @endif

                            <a href="{{route('Tasks.create')}}">
                                <button class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow">
                                    Add Task
                                  </button>
                            </a>
                         
                          </div>
                                    
                                </div>
                                <div class="col-md-12 mt-4">
                                    <div class="row">
                                        @if (count($tasks))
                                            @foreach ($tasks as $task)
                                                <div
                                                    class="p-6 mt-4 ml-2 sm:rounded-lg dark:bg-gray-800 border border-gray-200 dark:border-gray-700 md:border-l">
                                                    <div class="card-body">
                                                        <h5 class="card-title">{{ $task->title }}</h5>
                                                        <h6 class="card-subtitle mb-2 text-body-secondary">
                                                            {{ $task->category }}</h6>
                                                        <p class="card-text">{{ $task->description }}</p>
                                                        <p class="card-text">{{ $task->due_date }}</p>
                                                        <a href="#" class="card-link">Card link</a>
                                                        <a href="#" class="card-link">Another link</a>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="col-md-12 mb-4">
                                                No Tasks Found. Please Add Tasks.
                                            </div>
                                        @endif
                                        @if (count($tasks))
                                            <div class="col-md-10">
                                                {{ $tasks->appends(Request::query())->links() }}
                                            </div>
                                        @endif

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <x-slot name='js'>
        <script>
            var query = {};
            @if (Request::query('category'))
                Object.assign(query, {
                    'category': "{{ Request::query('category') }}"
                });
            @endif
            @if (Request::query('sort_by'))
                Object.assign(query, {
                    'sort_by': "{{ Request::query('sort_by') }}"
                });
            @endif
            function filter_tasks(value) {
                Object.assign(query, {
                    'category': value
                });
                window.location.href = "{{ route('Tasks.index') }}" + '?' + $.param(query);

            }

            function sort_by(value) {
                Object.assign(query, {
                    'sort_by': value
                });
                window.location.href = "{{ route('Tasks.index') }}" + '?' + $.param(query);

            }


            $("#task_add_form").validate({
                rules: {
                    title: {
                        required: true,
                        maxlength: 100
                    },
                    description: {
                        maxlength: 500
                    },
                    category: {
                        required: true
                    },
                    due_date: {
                        required: true
                    },

                },
                messages: {
                    caption: {
                        required: "Please ,Enter Task title!",
                        maxlength: jQuery.validator.format("At Max {100} characters required!")
                    },
                    description: {
                        maxlength: jQuery.validator.format("At Max {500} characters required!")
                    },
                    category: {
                        required: "Please ,Select Task category!"
                    },
                    category: {
                        required: "Please ,Enter  due Date!"
                    },

                },
                errorPlacement: function(error, element) {
                    error.insertAfter(element);
                }
            });






            function reset(e) {
                e.wrap('<form>').closest('form').get(0).reset();
                e.unwrap();
            }

            $(".dropzone").change(function() {
                readFile(this);
            });

            $('.dropzone-wrapper').on('dragover', function(e) {
                e.preventDefault();
                e.stopPropagation();
                $(this).addClass('dragover');
            });

            $('.dropzone-wrapper').on('dragleave', function(e) {
                e.preventDefault();
                e.stopPropagation();
                $(this).removeClass('dragover');
            });

            $('.remove-preview').on('click', function() {
                var boxZone = $(this).parents('.preview-zone').find('.box-body');
                var previewZone = $(this).parents('.preview-zone');
                var dropzone = $(this).parents('.form-group').find('.dropzone');
                boxZone.empty();
                previewZone.addClass('hidden');
                reset(dropzone);
            });
        </script>
    </x-slot>
</x-app-layout>
