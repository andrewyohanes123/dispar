import React, { Component, Fragment } from 'react';
import {Map, GoogleApiWrapper, Marker} from 'google-maps-react';

export class FormMap extends Component {
  markerMove(a, b) {
    this.props.onCoordChange({latitude : b.position.lat(), longitude : b.position.lng()});
  }
  
  render() {
    return (
      <Fragment>
        <div className="card" style={{ height : '60vh' }}>
          <Map 
          google={this.props.google}
          zoom={15}
          style={{ width : '100%', height : '100%', position : 'relative' }}
          initialCenter={{lat: 1.4692688, lng : 124.8391552}}
          >
            <Marker draggable={true} onDragend={this.markerMove.bind(this)} />
          </Map>
        </div>
      </Fragment>
    )
  }
}

export default GoogleApiWrapper({
  apiKey : 'AIzaSyCcOHj7oMMVUm2TBA23EDtW-OR1BAVZHvY'
})(FormMap);
