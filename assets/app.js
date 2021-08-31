/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
// import './styles/app.css';
import 'react-notifications/lib/notifications.css';
import React from "react";
import ReactDOM from "react-dom";
import { NotificationContainer, NotificationManager } from 'react-notifications';
// start the Stimulus application
// import './bootstrap';

function LoveStar($id) {

    const showMessage = (message, type) => {
        console.log('%c⧭', 'color: #00e600', type);
        console.log('%c⧭', 'color: #ff0000', message);
        if (type === "info") {
            NotificationManager.info(message);
        } else {
            NotificationManager.error(message);

        }
    }
    const handlerequest = () => {
        let pathname = window.location.pathname;
        let idCelebrite = pathname.slice(pathname.lastIndexOf('/') + 1);

        window.fetch(`/celebrite/fame/${idCelebrite}`)
            .then((response) => {
                return response.json();
            })
            .then((data) => {
                showMessage(data.message, data.type);
            })
    }
    return (
        <div>
            <button onClick={handlerequest}>J'aime</button>
            <NotificationContainer />
        </div>
    )
}
if (document.getElementById("loveStar")) {
    ReactDOM.render(<LoveStar />, document.getElementById("loveStar"));
};
