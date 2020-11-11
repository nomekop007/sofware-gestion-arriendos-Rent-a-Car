// If absolute URL from the remote server is provided, configure the CORS
// header on that server.


const canvasVisorPDF = {
    page_count: "",
    page_num: "",
    prev: "",
    next: "",
    pdfDoc: null,
    pageNum: 1,
    pageRendering: false,
    pageNumPending: null,
    scale: 2,
    canvasVisorPDF: "",
    ctxVisorPDF: ""
}

function mostrarVisorPDF(base64, [id_canvas, id_page_count, id_page_num, id_prev, id_next]) {

    canvasVisorPDF.canvasVisorPDF = document.getElementById(id_canvas);
    canvasVisorPDF.ctxVisorPDF = canvasVisorPDF.canvasVisorPDF.getContext('2d');
    canvasVisorPDF.page_count = id_page_count;
    canvasVisorPDF.page_num = id_page_num;
    canvasVisorPDF.prev = id_prev;
    canvasVisorPDF.next = id_next;
    canvasVisorPDF.pageNum = 1;

    document.getElementById(canvasVisorPDF.prev).addEventListener('click', onPrevPage);
    document.getElementById(canvasVisorPDF.next).addEventListener('click', onNextPage);

    pdfjsLib.getDocument({ data: atob(base64) }).promise.then(function(pdfDoc_) {
        canvasVisorPDF.pdfDoc = pdfDoc_;
        document.getElementById(canvasVisorPDF.page_count).textContent = canvasVisorPDF.pdfDoc.numPages;

        // Initial/first page rendering
        renderPage(canvasVisorPDF.pageNum);
    }).catch((err) => {
        console.log(err);
    });

}




/**
 * Get page info from document, resicanvasVisorPDFe canvasVisorPDF accordingly, and render page.
 * @param num Page number.
 */
function renderPage(num) {
    canvasVisorPDF.pageRendering = true;
    // Using promise to fetch the page
    canvasVisorPDF.pdfDoc.getPage(num).then(function(page) {
        let viewport = page.getViewport({ scale: canvasVisorPDF.scale });
        canvasVisorPDF.canvasVisorPDF.height = viewport.height;
        canvasVisorPDF.canvasVisorPDF.width = viewport.width;
        // Render PDF page into canvas context
        let renderContext = {
            canvasContext: canvasVisorPDF.ctxVisorPDF,
            viewport: viewport
        };
        let renderTask = page.render(renderContext);

        // Wait for rendering to finish
        renderTask.promise.then(function() {
            canvasVisorPDF.pageRendering = false;
            if (canvasVisorPDF.pageNumPending !== null) {
                // New page rendering is pending
                renderPage(canvasVisorPDF.pageNumPending);
                canvasVisorPDF.pageNumPending = null;
            }
        });
    });

    // Update page counters
    document.getElementById(canvasVisorPDF.page_num).textContent = num;
}

/**
 * If another page rendering in progress, waits until the rendering is
 * finised. Otherwise, executes rendering immediately.
 */
function queueRenderPage(num) {
    if (canvasVisorPDF.pageRendering) {
        canvasVisorPDF.pageNumPending = num;
    } else {
        renderPage(num);
    }
}


/**
 * Displays previous page.
 */
function onPrevPage() {
    if (canvasVisorPDF.pageNum <= 1) {
        return;
    }
    canvasVisorPDF.pageNum--;
    queueRenderPage(canvasVisorPDF.pageNum);
}

/**
 * Displays next page.
 */
function onNextPage() {
    if (canvasVisorPDF.pageNum >= canvasVisorPDF.pdfDoc.numPages) {
        return;
    }
    canvasVisorPDF.pageNum++;
    queueRenderPage(canvasVisorPDF.pageNum);
}