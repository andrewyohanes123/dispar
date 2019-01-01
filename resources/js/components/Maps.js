import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import HomeMap from './HomeMap';

export default class Maps extends Component {
  render() {
    return (
      <div style={{ position : 'relative' }}>
        <HomeMap />
      </div>
    )
  }
}

if (document.getElementById('homemap')) {
  ReactDOM.render(<Maps />, document.getElementById('homemap'));
}