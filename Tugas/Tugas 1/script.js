let input = "";

function appendToInput(value) {
    input += value;
    document.getElementById("result").value = input;
}

function calculateResult() {
    try {
        // Mengganti pangkat dengan Math.pow() dan menghitung modulus dengan cara manual
        let result = eval(input.replace(/\^/g, '**'));
        
        // Menangani modulus secara manual
        if (input.includes('%')) {
            const parts = input.split('%');
            const num1 = parseFloat(parts[0]);
            const num2 = parseFloat(parts[1]);
            result = num1 % num2; // Hitung modulus
        }

        input = result.toString();
        document.getElementById("result").value = input;
    } catch (error) {
        alert("Input tidak valid");
        clearAll();
    }
}

function clearAll() {
    input = "";
    document.getElementById("result").value = input;
}
