@if (session('warning'))
    <div class="alert alert-warning" style="
        padding: 20px; 
        border: 2px solid #ffc107; 
        background-color: #fff3cd; 
        color: #856404; 
        border-radius: 8px; 
        font-size: 18px; 
        font-weight: bold;
        display: flex;
        align-items: center;
    ">
        <span style="
            color: #28a745; 
            font-size: 24px; 
            margin-right: 12px; 
            text-shadow: 0 0 8px #28a745, 0 0 12px #28a745;
        ">
            &#10004;
        </span>
        {{ session('warning') }}
    </div>
@endif

