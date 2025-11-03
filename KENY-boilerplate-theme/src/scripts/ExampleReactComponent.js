import React, { useState } from "react";

function ExampleReactComponent() {
  const [clickCount, setClickCount] = useState(0);

  return (
    <div
      className="example-react-component"
      onClick={() => setClickCount((prev) => prev + 1)}
    >
      <h1>React! Now!</h1>
      <p>You have clicked on this component {clickCount} times too much.</p>
    </div>
  );
}

export default ExampleReactComponent;
