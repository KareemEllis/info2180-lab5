window.addEventListener("load", () => {
    
    const lookupBtn = document.querySelector("#lookup")
    const resultDiv = document.querySelector("#result")
    const inputField = document.querySelector("#country")

    lookupBtn.addEventListener("click", (e) => {
        e.preventDefault()
        alert("Clicked!")

        let userInput = inputField.value;
        userInput.trim()

        let url = `world.php?country=${userInput}`

        fetch(url)
        .then(response => {
            if(response.ok){return response.text()}
            else{return Promise.reject('Something was wrong with fetch request!')}
        })
        .then(data => {
            alert(data)
            resultDiv.innerHTML = data
        })
        .catch(error => console.log(`ERROR HAS OCCURRED: ${error}`))
    })

})