/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
// import './styles/app.css';
import 'react-notifications/lib/notifications.css';
import './style.css';
import React, { useState, useEffect } from "react";
import ReactDOM from "react-dom";
import { NotificationContainer, NotificationManager } from 'react-notifications';
// start the Stimulus application
// import './bootstrap';


function Medias(props) {
    // const clickImage = () => { };
    console.log(props);
    const [actualMedia, setActualMedia] = useState(0);
    const handleSelectMedia = (index) => {
        console.log(index);
        setActualMedia(index);
    }
    return (
        // <image onClick={clickImage}></image>
        <div className="parentMedias">
            <div className="mainMedias">
                {props.data && props.data[actualMedia] && (
                    props.data[actualMedia].type === "youtube" ? (
                        <iframe width="560" height="315" src="https://www.youtube.com/embed/xpyrefzvTpI" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        // <iframe src={props.data[actualMedia].url}></iframe>
                    ) : (
                        <img src={`/${props.data[actualMedia].url}`} />
                    )
                )}
            </div>
            <div className="listMedias">
                <ul>
                    {props.data.map((item, index) => {
                        return (
                            <li key={item.id} onClick={() => handleSelectMedia(index)}>
                                <img src={item.type === "youtube" ? "/images/coeur2.jpg" : `/${item.url}`} />
                            </li>
                        )
                    })}
                </ul>
            </div>
        </div>
    )
}

function LoveStar($id) {
    let pathname = window.location.pathname;
    let idCelebrite = pathname.slice(pathname.lastIndexOf('/') + 1);

    const [mesDatas, setMesDatas] = useState([]);

    useEffect(() => {
        window.fetch(`/celebrite/medias/${idCelebrite}`)
            .then((response) => {
                return response.json();
            })
            .then((data) => {
                setMesDatas(data.medias);
            })

    }, []);

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
            <Medias data={mesDatas} />

            <NotificationContainer />
        </div>
    )
}
if (document.getElementById("loveStar")) {
    ReactDOM.render(<LoveStar />, document.getElementById("loveStar"));
};


