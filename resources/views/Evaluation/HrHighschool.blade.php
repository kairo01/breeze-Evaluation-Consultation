<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('HighSchool Course') }}
        </h2>
    </x-slot>

    <link rel="stylesheet" href="{{ asset('css/Evaluation/Hrhighschool.css') }}">

    <div class="grid-container">
        <div class="section">
            <h2>GRADE 7</h2>
            <div>
                <a href="{{('Grade7') }}">
                    <button>Grade 7</button>
                </a>
            </div>

        </div>

        <div class="section">
            <h2>GRADE 8</h2>
            <div>
                <a href="{{('Grade8') }}">
                    <button>Grade 8</button>
                </a>
            </div>
        </div>

        <div class="section">
            <h2>GRADE 9</h2>
            <div>
                <a href="{{('Grade9') }}">
                    <button>Grade 9</button>
                </a>
            </div>
        </div>

        <div class="section">
            <h2>GRADE 10</h2>
            <div>
                <a href="{{('Grade10') }}">
                    <button>Grade 10</button>
                </a>
            </div>
        </div>

        <div class="section">
            <h2>GRADE 11</h2>
            <div>
                <a href="{{('Grade11Lovelace') }}">
                    <button>LoveLace</button>
                </a>
            </div>
            <div>
                <a href="{{('Grade11Duflo') }}">
                    <button>Duflo</button>
                </a>
            </div>
            <div>
                <a href="{{('Grade11StClare') }}">
                    <button>St.Clare</button>
                </a>
            </div>
            <div>
                <a href="{{('Grade11EsCoZier') }}">
                    <button>Escozier</button>
                </a>
            </div>
             <div>
                <a href="{{('Grade11Aristotle') }}">
                    <button>Pythagoras/
                        Aristotle
                    </button>
                </a>
            </div>
        </div>

        <div class="section">
            <h2>GRADE 12</h2>
            <div>
                <a href="{{('Torvalds') }}">
                    <button>Torvalds</button>
                </a>
            </div>
            <div>
                <a href="{{('Marshall') }}">
                    <button>Marshall</button>
                </a>
            </div>
             <div>
                <a href="{{('Marcus') }}">
                    <button>MarCus</button>
                </a>
            </div>
              <div>
                 <a href="{{('SanPedroCalungsod') }}">
                    <button>SanPedro 
                            Calungsod</button>
                </a>
            </div>
               <div>
                  <a href="{{('Einstein') }}">
                    <button>Fibonacci/
                            Einstein</button>
                  </a>
               </div>
        </div>
    </div>
            <a href="{{ 'HrStudentList' }}">
        <button class="back-button">Back</button>
    </a>

</x-app-layout>
