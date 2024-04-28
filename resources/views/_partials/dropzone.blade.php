<!--Dropzone-->
<div class="dropzone p-0 d-flex justify-content-center" id="myDropzone" data-field="dz" style="cursor: default; border: none; overflow: hidden;">
    <input type="hidden" id="uploaded_file" name="firmwareFile" value="">
    <div class="dz-message needsclick" style="cursor: default; color: #566a7f; margin: 4.0rem 0; font-weight: 500; text-align: center; font-size: 1.625rem; width:100%; text-align:center;">
    </div>
    <div hidden id="preview-template-continer">
      <div class="dz-preview" id="dz-preview-template">
        <div class="dz-details dz-preview dz-processing me-4" style="
          width: fit-content;
          border: 0 solid #d9dee3;
          border-radius: 0.375rem;
          box-shadow: 0 2px 6px 0 rgba(67,89,113,.12);
          position: relative;
          vertical-align: top;
          background: #fff;
          font-size: .8125rem;
          box-sizing: content-box;
          cursor: default;
        ">

          <div class="dz-thumbnail" style="
            border-bottom: 1px solid #d9dee3;
            background: rgba(67,89,113,.025);
            border-top-left-radius: calc(0.375rem - 1px);
            border-top-right-radius: calc(0.375rem - 1px);
            width: 10rem;
            position: relative;
            padding: 0.625rem;
            height: 7.5rem;
            text-align: center;
            box-sizing: content-box;
          ">

            <img data-dz-thumbnail style="
              max-height: 100%;
              max-width: 100%;
              top: 50%;
              position: relative;
              transform: translateY(-50%) scale(1);
              margin: 0 auto;
              display: block;
            ">

            <span data-dz-nopreview id="nopreview" class="dz-nopreview" style="
              color: #a1acb8;
              font-weight: 500;
              text-transform: uppercase;
              font-size: .6875rem;
              position: relative;
              top: 50%;
              transform: translateY(-50%) scale(1);
              margin: 0 auto;
              display: block;
            ">No preview</span>

            <div class="dz-success-mark" style="
              background-color: rgba(35,52,70,.5);
              display: block;
              position: absolute;
              left: 50%;
              top: 50%;
              margin-left: -1.875rem;
              margin-top: -1.875rem;
              height: 3.75rem;
              width: 3.75rem;
              border-radius: 50%;
              background-position: center center;
              background-size: 1.875rem 1.875rem;
              background-repeat: no-repeat;
              box-shadow: 0 0 1.25rem rgba(0,0,0,.06);
              font-size: 38px;
              color: #4ad44a;
            ">✔</div>

            <div class="dz-error-mark" style="
              background-color: rgba(35,52,70,.5);
              display: block;
              position: absolute;
              left: 50%;
              top: 50%;
              margin-left: -1.875rem;
              margin-top: -1.875rem;
              height: 3.75rem;
              width: 3.75rem;
              border-radius: 50%;
              background-position: center center;
              background-size: 1.875rem 1.875rem;
              background-repeat: no-repeat;
              box-shadow: 0 0 1.25rem rgba(0,0,0,.06);
              font-size: 38px;
              color: #ec4a4a;
            ">✘</div>

            <div class="dz-error-message" style="
              background: rgba(255,62,29,.8);
              border-top-left-radius: 0.375rem;
              border-top-right-radius: 0.375rem;
              border-bottom-left-radius: 0;
              border-bottom-right-radius: 0;
              position: absolute;
              top: -1px;
              left: -1px;
              bottom: -1px;
              right: -1px;
              color: #fff;
              z-index: 40;
              width: 100%;
              text-align: left;
              overflow: auto;
              font-weight: 500;
            ">
              <span data-dz-errormessage id="dz-error-message"></span>
            </div>
            
            <div class="progress">
              <div data-dz-uploadprogress class="progress-bar progress-bar-primary" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
          </div>

          <div data-dz-name class="dz-filename" style="
            position: absolute;
            overflow: hidden;
            padding: 0.625rem 0.625rem 0 0.625rem;
            background: #fff;
            white-space: nowrap;
            text-overflow: ellipsis;
            width: -webkit-fill-available;
          "></div>

          <div data-dz-size class="dz-size" style="
            color: #a1acb8;
            padding: 1.875rem 0.625rem 0.625rem 0.625rem;
            font-size: .6875rem;
            font-style: italic;
          ">
            <strong></strong>
          </div>

        </div>

        <a data-dz-remove class="dz-remove" href="javascript:undefined;" style="
          color: #697a8d;
          border-top: 1px solid #d9dee3;
          border-bottom-right-radius: calc(0.375rem - 1px);
          border-bottom-left-radius: calc(0.375rem - 1px);
          display: block;
          text-align: center;
          padding: 0.375rem 0;
          font-size: .75rem;
        ">Remove file</a>
        
      </div>
    </div>
  </div>