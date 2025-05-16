<div class = "user-count"><center>Total Registered Users:<span class="totalcount">{{$members->total() }}</span></center></div>

<div class="buttons-container">
    <button class="btn1 {{ Request::routeIs('membership') ? 'btn-primary active' : 'btn-outline-teal' }}">
        <a href="{{ route('membership') }}">All</a>
    </button>
    <button class="btn1 {{ Request::routeIs('mechanical') ? 'btn-primary active' : 'btn-outline-teal' }}">
        <a href="{{ route('mechanical') }}">Mechanical</a>
    </button>
    <button class="btn1 {{ Request::routeIs('building') ? 'btn-primary active' : 'btn-outline-teal' }}">
        <a href="{{ route('building') }}">Building</a>
    </button>
    <button class="btn1 {{ Request::routeIs('electrical') ? 'btn-primary active' : 'btn-outline-teal' }}">
        <a href="{{ route('electrical') }}">Electrical</a>
    </button>
    <button class="btn1 {{ Request::routeIs('medical') ? 'btn-primary active' : 'btn-outline-teal' }}">
        <a href="{{ route('medical') }}">Medical</a>
    </button>
    <button class="btn1 {{ Request::routeIs('architecture') ? 'btn-primary active' : 'btn-outline-teal' }}">
        <a href="{{ route('architecture') }}">Architecture</a>
    </button>
    <button class="btn1 {{ Request::routeIs('accfin') ? 'btn-primary active' : 'btn-outline-teal' }}">
        <a href="{{ route('accfin') }}">Accounting & Finance</a>
    </button>
    <button class="btn1 {{ Request::routeIs('mngsci') ? 'btn-primary active' : 'btn-outline-teal' }}">
        <a href="{{ route('mngsci') }}">Management Science</a>
    </button>
    <button class="btn1 {{ Request::routeIs('busadmin') ? 'btn-primary active' : 'btn-outline-teal' }}">
        <a href="{{ route('busadmin') }}">Business Administration</a>
    </button>
    <button class="btn1 {{ Request::routeIs('purapp') ? 'btn-primary active' : 'btn-outline-teal' }}">
        <a href="{{ route('purapp') }}">Pure and Applied</a>
    </button>
    <button class="btn1 {{ Request::routeIs('matphy') ? 'btn-primary active' : 'btn-outline-teal' }}">
        <a href="{{ route('matphy') }}">Maths and Physics</a>
    </button>
    <button class="btn1 {{ Request::routeIs('medsci') ? 'btn-primary active' : 'btn-outline-teal' }}">
        <a href="{{ route('medsci') }}">Medical Sciences</a>
    </button>
    <button class="btn1 {{ Request::routeIs('environ') ? 'btn-primary active' : 'btn-outline-teal' }}">
        <a href="{{ route('environ') }}">Environmental</a>
    </button>
    <button class="btn1 {{ Request::routeIs('comstudies') ? 'btn-primary active' : 'btn-outline-teal' }}">
        <a href="{{ route('comstudies') }}">Communication Studies</a>
    </button>
    <button class="btn1 {{ Request::routeIs('social') ? 'btn-primary active' : 'btn-outline-teal' }}">
        <a href="{{ route('social') }}">Social Sciences</a>
    </button>
    <button class="btn1 {{ Request::routeIs('hospitality') ? 'btn-primary active' : 'btn-outline-teal' }}">
        <a href="{{ route('hospitality') }}">Hospitality</a>
    </button>
    <button class="btn1 {{ Request::routeIs('computing') ? 'btn-primary active' : 'btn-outline-teal' }}">
        <a href="{{ route('computing') }}">Computing & Informatics</a>
    </button>
</div>
