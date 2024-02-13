<x-app-layout>


    <div class="container-fluid bg-white shadow">
        <div class="row">
            <!-- h1 should have these classes:"font-bold text-xl text-center"  and be centered horizontaly and verticaly and box should have height 300px-->
            <div class="col-12 flex justify-center items-center h-screen" style="height: 300px;">
                <h1 class="text-xl font-bold leading-tight text-gray-900">{{ config('app.name', 'Laravel') }}</h1>
            </div>
        </div>
    </div>

    

</x-app-layout>
