import React, { Component } from 'react'

export default class UploadingModal extends Component {
  constructor(props) {
    super(props);

    this.state = {
      progressClass : "progress-bar progress-bar-striped bg-danger"
    }

    this.openModal = this.openModal.bind(this);
    this.closeModal = this.closeModal.bind(this);
  }
  openModal() {
    $('#uploading').modal('show');
  }

  closeModal() {
    $('#uploading').modal('hide');
  }

  componentWillReceiveProps(nextProps) {
    const {progress} = nextProps;
    let progressClass = this.state;
    if (progress < 30) {
      progressClass = "progress-bar progress-bar-striped bg-danger";
    } else if (progress < 55) {
      progressClass = "progress-bar progress-bar-striped bg-warning";
    } else if (progress < 100) {
      progressClass = "progress-bar progress-bar-striped bg-success";
    } else if (progress === 100) {
      progressClass = "progress-bar progress-bar-striped bg-primary";
    }

    this.setState({ progressClass });
  }

  render() {
    return (
      <div className="modal fade" data-backdrop="static" data-keyboard={false} id="uploading">
        <div className="modal-dialog">
          <div className="modal-content">
            <div className="modal-header">
              <p className="modal-title m-0">Sedang mengupload</p>
            </div>
            <div className="modal-body">
              <div className="progress" style={{ height : 15 }}>
                <div style={{ width : `${this.props.progress}%` }} className={this.state.progressClass}>{`${this.props.progress}%`}</div>
              </div>
            </div>
            <div className="modal-footer">
              {this.props.progress === 100 && <button data-dismiss="modal" className="btn btn-outline-primary btn-sm">Tutup</button>}
            </div>
          </div>
        </div>
      </div>
    )
  }
}
