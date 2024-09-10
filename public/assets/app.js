var payButton = document.getElementById("pay-button");
var form = document.getElementById("payment-form");

Frames.init("pk_sbox_5perulajltt36gyyofs3wjcoved");

Frames.addEventHandler(Frames.Events.CARD_VALIDATION_CHANGED, function (event) {
    console.log("CARD_VALIDATION_CHANGED: %o", event);

    payButton.disabled = !Frames.isCardValid();
});

Frames.addEventHandler(Frames.Events.CARD_SUBMITTED, function () {
    payButton.disabled = true;
    // display loader
});

Frames.addEventHandler(Frames.Events.CARD_TOKENIZED, function (data) {
    Frames.addCardToken(form, data.token);
    form.submit();
});

Frames.addEventHandler(
    Frames.Events.CARD_TOKENIZATION_FAILED,
    function (error) {
        // catch the error
    }
);

form.addEventListener("submit", function (event) {
    event.preventDefault();

    Frames.cardholder = {
        name: "John Smith",
        billingAddress: {
            addressLine1: "123 Anywhere St.",
            addressLine2: "Apt. 456",
            zip: "123456",
            city: "Anytown",
            state: "Alabama",
            country: "US",
        },
        phone: "5551234567",
    };

    Frames.submitCard();
});
