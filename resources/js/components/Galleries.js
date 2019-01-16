import React, { Component, Fragment } from 'react'
import ReactDOM from 'react-dom';
import axios from 'axios';
import baseurl from './BaseURL';
import Image from 'react-graceful-image';
import Pallete from 'react-palette';
import ImgsViewer from 'react-images-viewer';

export default class Galleries extends Component {
  constructor(props) {
    super(props);

    this.state = {
      pictures: [],
      page: 1,
      total_page: 2,
      total_pictures: 0,
      loading: false,
      open : false,
      currentImg : 0
    }

    this.getPictures = this.getPictures.bind(this);
  }

  componentDidMount() {
    this.setState({ loading: true }, () => this.getPictures());
  }

  getPictures() {
    const { page } = this.state;
    axios.get(`${baseurl}/gallery-api`, { params: { page } }).then(resp => this.setState({ pictures: [...this.state.pictures, ...resp.data.data], total_pictures: resp.data.total, total_page: resp.data.last_page, loading: false }));
  }

  loadMore(ev) {
    ev.preventDefault();
    const { page, total_page } = this.state;
    if (page >= total_page) return;
    this.setState(({ page }) => ({ page: page + 1 }), this.getPictures);
  }

  render() {
    return (
      <Fragment>
        {this.state.loading ?
          <div className="card border-0 shadow-sm">
            <div className="card-body text-center">
              <h1 className="m-0">Loading</h1>
            </div>
          </div> :
          (this.state.pictures.length > 0) ?
            <div className="card-columns">
              {
                this.state.pictures.map((pic, i) => (<Picture key={pic.id} index={i} openViewer={currentImg => this.setState({ currentImg, open : true })} {...pic} />))
              }
            </div>
            :
            <div className="card border-0 shadow-sm">
              <div className="card-body text-center">
                <h1 className="m-0">Loading</h1>
              </div>
            </div>
        }
        <Fragment>
          {this.state.page < this.state.total_page &&
            <Fragment>
              <hr />
              <div className="d-flex flex-row justify-content-center">
                <button onClick={this.loadMore.bind(this)} className="btn btn-link d-block">Load more</button>
              </div>
            </Fragment>}
        </Fragment>
        <ImgsViewer 
        imgs={this.state.pictures.map(pic => ({ src : `${baseurl}/storage/img/${pic.photo}`, caption : pic.site.name }))}
        currImg={this.state.currentImg}
        isOpen={this.state.open}
        leftArrowTitle="Sebelumnya"
        rightArrowTitle="Selanjutnya"
        showThumbnails={true}
        onClickThumbnail={currentImg => this.setState({ currentImg })}
        onClickPrev={() => this.setState(({currentImg}) => ({ currentImg : currentImg - 1  }))}
        onClickNext={() => this.setState(({currentImg}) => ({ currentImg : currentImg + 1  }))}
        onClose={() => this.setState({ open : false })}
        />
      </Fragment>
    )
  }
}

const Picture = props => (
  <div onClick={() => props.openViewer(props.index)} className="card border-0 shadow-sm position-relative">
    <Pallete image={`${baseurl}/storage/img/${props.photo}`}>
      {pallete => (<Image
        onClick={() => alert('click')}
        src={`${baseurl}/storage/img/${props.photo}`}
        className="card-img"
        placeholderColor={pallete.darkVibrant}
      />)}
    </Pallete>
  </div>
)

if (document.getElementById('galleries')) {
  ReactDOM.render(<Galleries />, document.getElementById('galleries'));
}
