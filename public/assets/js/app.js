
const test = function() {
    console.log("hello world");
}

setTimeout(() => {
    document.querySelectorAll('.alert').forEach(error => error.remove());
}, 3000);