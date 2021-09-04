import "./style/parallax.css";

import React, { useEffect, useState } from "react";

import { Parallax } from "react-scroll-parallax";

function StarsListParallax() {
  const [stars, setStars] = useState([]);
  useEffect(() => {
    window
      .fetch("/celebrite/listrequest/all")
      .then((response) => {
        return response.json();
      })
      .then((data) => {
        setStars(data.celebrities);
      });
  }, []);
  const settings = [
    {
      //première image
      y: [100, 0],
      x: [0, 165],
    },
    {
      //deuxième image
      y: [100, 0],
      x: [100, -225],
    },
    {
      //troisieme image
      y: [300, -100],
      x: [50, 50],
    },
    {
      //quatrième image
      y: [50, 40],
      x: [20, 30],
    },
    {
      //cinquième image
      y: [100, 0],
      x: [50, 80],
    },
    {
      //sixième image
      y: [40, 0],
      x: [150, 0],
    },
    {
      //septieme image
      y: [100, 0],
      x: [120, 0],
    },
    {
      //huitième image
      y: [50, 30],
      x: [50, 80],
    },
    {
      //neuvième image
      y: [0, 0],
      x: [10, 30],
    },
  ];
  const ParallaxImage = (props) => (
    <Parallax
      className={`image_${props.index}`}
      y={settings[props.index].y}
      x={settings[props.index].x}
      tagInner="div"
      
    >
      <img width="400" className={`parallax-image`} src={`/${props.image}` } />
    </Parallax>
  );

  return (
    <div>
      {stars.map((item, index) => {
        return <ParallaxImage key={item.id} index={index} image={item.image} />;
      })}
    </div>
  );
}

export default StarsListParallax;
