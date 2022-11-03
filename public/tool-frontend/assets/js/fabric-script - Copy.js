(function () {

    // CLick HTML Elements
    let toolSelect = document.getElementById('toolSelect');
    let toolPen = document.getElementById('toolPen');
    let toolText = document.getElementById('toolText');
    let toolImage = document.getElementById('toolImage');
    let toolCopy = document.getElementById('toolCopy');
    let toolUndo = document.getElementById('toolUndo');
    let toolRedo = document.getElementById('toolRedo');
    let toolRemoveAll = document.getElementById('toolRemoveAll');

    let penToolbar = document.getElementById('penToolbar');
    let penFreeHand = document.getElementById('penFreeHand');
    let penRect = document.getElementById('penRect');
    let penEllipse = document.getElementById('penEllipse');
    let penLine = document.getElementById('penLine');
    let penArrow = document.getElementById('penArrow');
    let penColor = document.getElementById('penColor');
    let penSize = document.getElementById('penSize');


    let textToolbar = document.getElementById('textToolbar');
    let textAlignJustify = document.getElementById('textAlignJustify');
    let textAlignLeft = document.getElementById('textAlignLeft');
    let textAlignCenter = document.getElementById('textAlignCenter');
    let textAlignRight = document.getElementById('textAlignRight');
    let textBold = document.getElementById('textBold');
    let textItalic = document.getElementById('textItalic');
    let textUnderline = document.getElementById('textUnderline');
    let textColor = document.getElementById('textColor');
    let textSize = document.getElementById('textSize');


    let imageToolbar = document.getElementById('imageToolbar');
    let imageOpacity = document.getElementById('imageOpacity');
    let imageUpload = document.getElementById('imageUpload');

    let svgToolbar = document.getElementById('svgToolbar');

    let removeObject = document.getElementById('removeObject');

    let downloadBtn = document.getElementById('downloadBtn');


    // Default Values
    let selectedPenColor = 'rgba(253,61,61,1)';
    let selectedStrokeColor = 'rgba(253,61,61,1)';
    let selectedFillColor = 'rgba(253,61,61,1)';
    let selectedTextColor = 'rgba(0,0,0,1)';
    let penSizeValue = 5;
    let penStrokeWidth = 5;
    let ellipseStrokeWidth = 5;
    let lineStrokeWidth = 5;
    let arrowStrokeWidth = 5;
    let textSizeValue = 40;
    let fontFamily = 'Times New Roman';

    let rect;
    let circle;
    let line;
    let text;
    let image;


    // Copy and Paste Object
    function copyObject() {
        // clone what are you copying since you
        // may want copy and paste on different moment.
        // and you do not want the changes happened
        // later to reflect on the copy.
        canvas.getActiveObject().clone(function (cloned) {
            _clipboard = cloned;
        });
    }

    function pasteObject() {
        // clone again, so you can do multiple copies.
        _clipboard.clone(function (clonedObj) {
            canvas.discardActiveObject();
            clonedObj.set({
                left: clonedObj.left + 50,
                top: clonedObj.top + 10,
                evented: true,
            });
            if (clonedObj.type === 'activeSelection') {
                // active selection needs a reference to the canvas.
                clonedObj.canvas = canvas;
                clonedObj.forEachObject(function (obj) {
                    canvas.add(obj);
                });
                // this should solve the unselectability
                clonedObj.setCoords();
            } else {
                canvas.add(clonedObj);
            }
            _clipboard.top += 50;
            _clipboard.left += 10;
            canvas.setActiveObject(clonedObj);
            canvas.requestRenderAll();
        });
    }

    // Copy and Paste object from Keyboard
    const copyAndPasteObjectKeyboard = (canvas) => {
        let activeObject = canvas.getActiveObjects();
        if (activeObject) {
            document.addEventListener('keydown', function (event) {
                if ((event.ctrlKey || event.metaKey) && event.keyCode == 67) {
                    if (canvas.getActiveObject()) {
                        copyObject();
                    } else {
                        alert('please select an object to copy');
                    }

                }
                if ((event.ctrlKey || event.metaKey) && event.keyCode == 86) {
                    if (typeof _clipboard !== 'undefined') {
                        pasteObject();
                    }
                }
            });
        }
    }

    // Selected Object Tool Bar
    const selectedObjectToolBar = (canvas) => {
        canvas.on('selection:created', onObjectCreated);

        function onObjectCreated() {
            let objType = canvas.getActiveObject().type;
            //console.log(objType);
            if (objType === 'path' || objType === 'group' || objType === 'line' || objType === 'lineArrow') {
                document.getElementById('penColor').style.display = 'block';
                document.getElementById('strokeColor').style.display = 'none';
                document.getElementById('fillColor').style.display = 'none';
                penToolbar.classList.remove('hasRemove');
                textToolbar.classList.add('hasRemove');
                imageToolbar.classList.add('hasRemove');

                let activeColor = '';
                let activeSvgColor = '';
                let activeObject = canvas.getActiveObject();
                if (activeObject) {
                    activeColor = activeObject.stroke;
                    activeSvgColor = activeObject.fill;
                }

                let activeObjectPenColorPicker = new ColorPicker.Default('#penColor', {
                    color: activeColor,
                    inline: false,
                    history: {
                        colors: ['#000000', '#2a2a2a', '#545454', '#7e7e7e', '#a8a8a8', '#d2d2d2', '#2c974b', '#ff4040', '#ff6518', '#ffbb3b', '#03bd9e', '#00a9ff', '#515ce6', '#9e5fff', '#ff5583']
                    }
                });
                activeObjectPenColorPicker.on('change', function (color) {
                    selectedPenColor = color.rgba;
                    let activeObject = canvas.getActiveObject();
                    if (activeObject) {
                        activeObject.set('stroke', selectedPenColor);
                        //activeObject.set('fill', selectedPenColor);
                        canvas.freeDrawingBrush.color = selectedPenColor;
                    }
                    canvas.requestRenderAll();
                });


                let activeSVGColorPicker = new ColorPicker.Default('#svgColor', {
                    color: activeSvgColor,
                    inline: false,
                    history: {
                        colors: ['#000000', '#2a2a2a', '#545454', '#7e7e7e', '#a8a8a8', '#d2d2d2', '#2c974b', '#ff4040', '#ff6518', '#ffbb3b', '#03bd9e', '#00a9ff', '#515ce6', '#9e5fff', '#ff5583']
                    }
                });


                // On SVG Change Color
                activeSVGColorPicker.on('change', function (color) {
                    //selectedPenColor = color.rgba;
                    let activeObject = canvas.getActiveObject();
                    if (activeObject) {

                        //SVG color change
                        let objType = canvas.getActiveObject().type;
                        if (objType === 'group') {
                            activeObject.forEachObject(function (path) {
                                path.set({
                                    fill: color.rgba,
                                    dirty: true
                                });
                            })
                        }
                        else {
                            activeObject.set({
                                fill: color.rgba,
                                dirty: true,
                            });
                            //activeObject.set('flipX', true);
                        }
                    }

                    canvas.requestRenderAll();
                });

            } else if (objType === 'rect' || objType === 'circle') {
                document.getElementById('penColor').style.display = 'none';
                document.getElementById('strokeColor').style.display = 'block';
                document.getElementById('fillColor').style.display = 'block';
                penToolbar.classList.remove('hasRemove');
                textToolbar.classList.add('hasRemove');
                imageToolbar.classList.add('hasRemove');

                let activeColor = '';
                let activeObject = canvas.getActiveObject();
                if (activeObject) {
                    activeColor = activeObject.stroke;
                }

                let activeObjectStrokeColorPicker = new ColorPicker.Default('#strokeColor', {
                    color: activeColor,
                    inline: false,
                    history: {
                        colors: ['#000000', '#2a2a2a', '#545454', '#7e7e7e', '#a8a8a8', '#d2d2d2', '#2c974b', '#ff4040', '#ff6518', '#ffbb3b', '#03bd9e', '#00a9ff', '#515ce6', '#9e5fff', '#ff5583']
                    }
                });
                activeObjectStrokeColorPicker.on('change', function (color) {
                    selectedStrokeColor = color.rgba;
                    let activeObject = canvas.getActiveObject();
                    if (activeObject) {
                        activeObject.set('stroke', selectedStrokeColor);
                        canvas.freeDrawingBrush.color = selectedStrokeColor;
                    }
                    canvas.requestRenderAll();
                });
                let fillColorPicker = new ColorPicker.Default('#fillColor', {
                    color: selectedFillColor,
                    inline: false,
                    history: {
                        colors: ['#000000', '#2a2a2a', '#545454', '#7e7e7e', '#a8a8a8', '#d2d2d2', '#2c974b', '#ff4040', '#ff6518', '#ffbb3b', '#03bd9e', '#00a9ff', '#515ce6', '#9e5fff', '#ff5583']
                    }
                });
                // Only Rectangle and Circle fill color
                let fillColor = document.getElementById('fillColor');
                fillColor.addEventListener('click', () => {
                    let activeObject = canvas.getActiveObject();
                    if (activeObject) {
                        let objType = activeObject.type;
                        if (objType === 'rect' || objType === 'circle') {
                            activeObject.set('fill', selectedFillColor);
                        }
                    }
                    canvas.requestRenderAll();
                })
                // On Fill Change Color for Rectangle and Circle
                fillColorPicker.on('change', function (color) {
                    selectedFillColor = color.rgba;
                    let activeObject = canvas.getActiveObject();
                    if (activeObject) {
                        let objType = activeObject.type;
                        if (objType === 'rect' || objType === 'circle') {
                            activeObject.set('fill', selectedFillColor);
                        }
                    }
                    canvas.requestRenderAll();
                });


            } else if (objType === 'i-text') {
                penToolbar.classList.add('hasRemove');
                textToolbar.classList.remove('hasRemove');
                imageToolbar.classList.add('hasRemove');

                text.fontSize = 40;

                let activeFont = '';
                let activeObject = canvas.getActiveObject();
                if (activeObject) {
                    activeFont = activeObject.fontFamily;
                }

                $('#textFontFamily').trigger('setFont', activeFont);

            } else if (objType === 'image') {
                penToolbar.classList.add('hasRemove');
                textToolbar.classList.add('hasRemove');
                imageToolbar.classList.remove('hasRemove');
            }

            canvas.requestRenderAll();
        }

        canvas.on('selection:updated', onObjectSelected);

        function onObjectSelected() {
            // check if type is a property of active element
            let objType = canvas.getActiveObject().type;
            //console.log(objType);
            if (objType === 'path' || objType === 'group' || objType === 'line' || objType === 'lineArrow') {

                document.getElementById('penColor').style.display = 'block';
                document.getElementById('strokeColor').style.display = 'none';
                document.getElementById('fillColor').style.display = 'none';
                penToolbar.classList.remove('hasRemove');
                textToolbar.classList.add('hasRemove');
                imageToolbar.classList.add('hasRemove');

                let activeColor = '';
                let activeSvgColor = '';
                let activeObject = canvas.getActiveObject();
                if (activeObject) {
                    activeColor = activeObject.stroke;
                    activeSvgColor = activeObject.fill;
                }

                let activeObjectPenColorPicker = new ColorPicker.Default('#penColor', {
                    color: activeColor,
                    inline: false,
                    history: {
                        colors: ['#000000', '#2a2a2a', '#545454', '#7e7e7e', '#a8a8a8', '#d2d2d2', '#2c974b', '#ff4040', '#ff6518', '#ffbb3b', '#03bd9e', '#00a9ff', '#515ce6', '#9e5fff', '#ff5583']
                    }
                });
                activeObjectPenColorPicker.on('change', function (color) {
                    selectedPenColor = color.rgba;
                    let activeObject = canvas.getActiveObject();
                    if (activeObject) {
                        activeObject.set('stroke', selectedPenColor);
                        canvas.freeDrawingBrush.color = selectedPenColor;
                    }
                    canvas.requestRenderAll();
                });


                let activeSVGColorPicker = new ColorPicker.Default('#svgColor', {
                    color: activeSvgColor,
                    inline: false,
                    history: {
                        colors: ['#000000', '#2a2a2a', '#545454', '#7e7e7e', '#a8a8a8', '#d2d2d2', '#2c974b', '#ff4040', '#ff6518', '#ffbb3b', '#03bd9e', '#00a9ff', '#515ce6', '#9e5fff', '#ff5583']
                    }
                });


                // On SVG Change Color
                activeSVGColorPicker.on('change', function (color) {
                    let activeObject = canvas.getActiveObject();
                    if (activeObject) {

                        //SVG color change
                        let objType = canvas.getActiveObject().type;
                        if (objType === 'group') {
                            activeObject.forEachObject(function (path) {
                                path.set({
                                    fill: color.rgba,
                                    dirty: true
                                });
                            })
                        }
                        else {
                            activeObject.set({
                                fill: color.rgba,
                                dirty: true,
                            });
                            //activeObject.set('flipX', true);
                        }
                    }

                    canvas.requestRenderAll();
                });



            } else if (objType === 'rect' || objType === 'circle') {
                document.getElementById('penColor').style.display = 'none';
                document.getElementById('strokeColor').style.display = 'block';
                document.getElementById('fillColor').style.display = 'block';
                penToolbar.classList.remove('hasRemove');
                textToolbar.classList.add('hasRemove');
                imageToolbar.classList.add('hasRemove');

                let activeColor = '';
                let activeObject = canvas.getActiveObject();
                if (activeObject) {
                    activeColor = activeObject.stroke;
                }

                let activeObjectStrokeColorPicker = new ColorPicker.Default('#strokeColor', {
                    color: activeColor,
                    inline: false,
                    history: {
                        colors: ['#000000', '#2a2a2a', '#545454', '#7e7e7e', '#a8a8a8', '#d2d2d2', '#2c974b', '#ff4040', '#ff6518', '#ffbb3b', '#03bd9e', '#00a9ff', '#515ce6', '#9e5fff', '#ff5583']
                    }
                });
                activeObjectStrokeColorPicker.on('change', function (color) {
                    selectedStrokeColor = color.rgba;
                    let activeObject = canvas.getActiveObject();
                    if (activeObject) {
                        activeObject.set('stroke', selectedStrokeColor);
                        canvas.freeDrawingBrush.color = selectedStrokeColor;
                    }
                    canvas.requestRenderAll();
                });

                let fillColorPicker = new ColorPicker.Default('#fillColor', {
                    color: selectedFillColor,
                    inline: false,
                    history: {
                        colors: ['#000000', '#2a2a2a', '#545454', '#7e7e7e', '#a8a8a8', '#d2d2d2', '#2c974b', '#ff4040', '#ff6518', '#ffbb3b', '#03bd9e', '#00a9ff', '#515ce6', '#9e5fff', '#ff5583']
                    }
                });
                // Only Rectangle and Circle fill color
                let fillColor = document.getElementById('fillColor');
                fillColor.addEventListener('click', () => {
                    let activeObject = canvas.getActiveObject();
                    if (activeObject) {
                        let objType = activeObject.type;
                        if (objType === 'rect' || objType === 'circle') {
                            activeObject.set('fill', selectedFillColor);
                        }
                    }
                    canvas.requestRenderAll();
                })
                // On Fill Change Color for Rectangle and Circle
                fillColorPicker.on('change', function (color) {
                    selectedFillColor = color.rgba;
                    let activeObject = canvas.getActiveObject();
                    if (activeObject) {
                        let objType = activeObject.type;
                        if (objType === 'rect' || objType === 'circle') {
                            activeObject.set('fill', selectedFillColor);
                        }
                    }
                    canvas.requestRenderAll();
                });


            } else if (objType === 'i-text') {
                penToolbar.classList.add('hasRemove');
                textToolbar.classList.remove('hasRemove');
                imageToolbar.classList.add('hasRemove');


                let activeFont = '';
                let activeObject = canvas.getActiveObject();
                if (activeObject) {
                    activeFont = activeObject.fontFamily;
                    $('#textFontFamily').trigger('setFont', activeFont);
                    //$('#textSize').find("select").prop("selectedIndex",0);
                    $('#textSize').each( function() {
                        $(this).val( $(this).find("option[selected]").val() );
                    });
                }


            } else if (objType === 'image') {
                penToolbar.classList.add('hasRemove');
                textToolbar.classList.add('hasRemove');
                imageToolbar.classList.remove('hasRemove');
            }
            canvas.requestRenderAll();
        }
    }


    // Remove Single or Multiple Active Object
    const removeObjectFunction = (canvas) => {
        removeObject.addEventListener('click', () => {
            let activeObject = canvas.getActiveObjects();
            if (activeObject) {
                let objectsInGroup = activeObject;
                canvas.discardActiveObject();
                objectsInGroup.forEach(function (object) {
                    canvas.remove(object);
                });
            }
        })
    }

    // Font Select
    const fontSelectFunction = (canvas) => {

        $('#textFontFamily').fontselect().on('change', function () {
            // Replace + signs with spaces for css
            var font = this.value.replace(/\+/g, ' ');

            // Split font into family and weight
            font = font.split(':');
            fontFamily = font[0];
            var fontWeight = font[1] || 400;

            //console.log('Font family', fontFamily, 'Font weight', fontWeight);

            let activeObject = canvas.getActiveObject();
            if (activeObject) {
                activeObject.set('fontFamily', fontFamily);
            }
            //canvas.getActiveObject().set("fontFamily", fontFamily);
            canvas.requestRenderAll();
        });
    }


    let penColorPicker = new ColorPicker.Default('#penColor', {
        color: 'rgba(253,61,61,1)',
        inline: false,
        history: {
            colors: ['#000000', '#2a2a2a', '#545454', '#7e7e7e', '#a8a8a8', '#d2d2d2', '#2c974b', '#ff4040', '#ff6518', '#ffbb3b', '#03bd9e', '#00a9ff', '#515ce6', '#9e5fff', '#ff5583']
        }
    });

    let strokeColorPicker = new ColorPicker.Default('#strokeColor', {
        color: 'rgba(253,61,61,1)',
        inline: false,
        history: {
            colors: ['#000000', '#2a2a2a', '#545454', '#7e7e7e', '#a8a8a8', '#d2d2d2', '#2c974b', '#ff4040', '#ff6518', '#ffbb3b', '#03bd9e', '#00a9ff', '#515ce6', '#9e5fff', '#ff5583']
        }
    });

    let fillColorPicker = new ColorPicker.Default('#fillColor', {
        color: 'rgba(253,61,61,1)',
        inline: false,
        history: {
            colors: ['#000000', '#2a2a2a', '#545454', '#7e7e7e', '#a8a8a8', '#d2d2d2', '#2c974b', '#ff4040', '#ff6518', '#ffbb3b', '#03bd9e', '#00a9ff', '#515ce6', '#9e5fff', '#ff5583']
        }
    });

    let svgColorPicker = new ColorPicker.Default('#svgColor', {
        color: 'rgba(52,55,247,1)',
        inline: false,
        history: {
            colors: ['#000000', '#2a2a2a', '#545454', '#7e7e7e', '#a8a8a8', '#d2d2d2', '#2c974b', '#ff4040', '#ff6518', '#ffbb3b', '#03bd9e', '#00a9ff', '#515ce6', '#9e5fff', '#ff5583']
        }
    });


    // On Text Change Color
    let textColorPicker = new ColorPicker.Default('#textColor', {
        color: 'rgba(0,0,0,1)',
        inline: false,
        history: {
            colors: ['#000000', '#2a2a2a', '#545454', '#7e7e7e', '#a8a8a8', '#d2d2d2', '#2c974b', '#ff4040', '#ff6518', '#ffbb3b', '#03bd9e', '#00a9ff', '#515ce6', '#9e5fff', '#ff5583']
        }
    });

    textColorPicker.on('change', function (color) {
        selectedTextColor = color.rgba;
        let activeObject = canvas.getActiveObject();
        if (activeObject) {
            activeObject.setSelectionStyles({fill: selectedTextColor});
        }
        canvas.requestRenderAll();
    });


    // On Pen Size Change
    const penSizeFunction = (canvas) => {
        penSize.addEventListener("input", function () {
            let penSizeValueEl = document.getElementById('penSizeValueEl');
            penStrokeWidth = parseInt(penSize.value);
            penSizeValueEl.innerHTML = `${penSize.value}%`;
            let activeObject = canvas.getActiveObject();
            if (activeObject) {
                activeObject.set({'strokeWidth': penStrokeWidth});
                canvas.requestRenderAll();
            }
            canvas.freeDrawingBrush.width = penStrokeWidth;
        });
    }

    // On Image Opacity Change
    const imageOpacityFunction = (canvas) => {
        imageOpacity.addEventListener("input", function () {
            let imageOpacityValue = document.getElementById('imageOpacityValue');
            let opacity = parseFloat(imageOpacity.value);
            //console.log(opacity)
            imageOpacityValue.innerHTML = imageOpacity.value;
            let activeObject = canvas.getActiveObject();
            if (activeObject) {
                activeObject.set({'opacity': opacity});
                canvas.requestRenderAll();
            }
        });
    }

    // Select Tool
    const toolSelectFunction = (canvas) => {
        toolSelect.addEventListener('click', () => {
            canvas.off('mouse:down').off('mouse:move').off('mouse:up');
            canvas.isDrawingMode = false;
            canvas.selection = true;
        })
    }

    const toolPenFunction = (canvas) => {
        toolPen.addEventListener('click', () => {

            document.getElementById('strokeColor').style.display = 'none';
            document.getElementById('fillColor').style.display = 'none';
            document.getElementById('penColor').style.display = 'block';

            penToolbar.classList.remove('hasRemove');
            textToolbar.classList.add('hasRemove');
            imageToolbar.classList.add('hasRemove');
            //Reset Canvas
            canvas.off('mouse:down').off('mouse:move').off('mouse:up');

            canvas.isDrawingMode = !canvas.isDrawingMode;
            canvas.freeDrawingBrush.width = penStrokeWidth;
            //console.log(penStrokeWidth)
            canvas.freeDrawingBrush.color = 'rgba(253,61,61,1)';
        })
    }

    const penFreeHandFunction = (canvas) => {
        penFreeHand.addEventListener('click', () => {

            document.getElementById('strokeColor').style.display = 'none';
            document.getElementById('fillColor').style.display = 'none';
            document.getElementById('penColor').style.display = 'block';

            //Reset Canvas
            canvas.off('mouse:down').off('mouse:move').off('mouse:up');

            canvas.isDrawingMode = !canvas.isDrawingMode;
            canvas.freeDrawingBrush.width = penStrokeWidth;
            canvas.freeDrawingBrush.color = 'rgba(253,61,61,1)';
        })
    }

    // Rectangle
    const penRectFunction = (canvas) => {
        penRect.addEventListener('click', () => {

            document.getElementById('strokeColor').style.display = 'block';
            document.getElementById('fillColor').style.display = 'block';
            document.getElementById('penColor').style.display = 'none';

            canvas.off('mouse:down').off('mouse:move').off('mouse:up');

            canvas.isDrawingMode = false;
            canvas.defaultCursor = 'crosshair';

            let isDown, origX, origY;
            canvas.on('mouse:down', function (o) {
                isDown = true;
                canvas.selection = false;

                let pointerBefore = canvas.getPointer(o.e);
                origX = pointerBefore.x;
                origY = pointerBefore.y;
                let pointer = canvas.getPointer(o.e);
                rect = new fabric.Rect({
                    left: origX,
                    top: origY,
                    radius: 1,
                    strokeWidth: penStrokeWidth,
                    stroke: 'rgba(253,61,61,1)',
                    fill: '',
                    originX: 'left',
                    originY: 'top',
                    width: pointer.x - origX,
                    height: pointer.y - origY,
                    angle: 0,
                });
                canvas.add(rect).setActiveObject(rect);
            });
            canvas.on('mouse:move', function (o) {
                if (!isDown) return;
                let pointer = canvas.getPointer(o.e);

                if (origX > pointer.x) {
                    rect.set({left: Math.abs(pointer.x)});
                }
                if (origY > pointer.y) {
                    rect.set({top: Math.abs(pointer.y)});
                }

                rect.set({width: Math.abs(origX - pointer.x)});
                rect.set({height: Math.abs(origY - pointer.y)});

                canvas.requestRenderAll();
            });

            canvas.on('mouse:up', function (o) {
                isDown = false;
                let activeObject = canvas.getActiveObject();
                if (activeObject) {
                    activeObject.setCoords();  //allows object to be selectable and moveable
                }
                canvas.off('mouse:down').off('mouse:move').off('mouse:up');
                canvas.defaultCursor = '';
                canvas.requestRenderAll();
            });
        })

    }

    // Ellipse
    const penEllipseFunction = (canvas) => {
        penEllipse.addEventListener('click', () => {

            document.getElementById('strokeColor').style.display = 'block';
            document.getElementById('fillColor').style.display = 'block';
            document.getElementById('penColor').style.display = 'none';

            canvas.off('mouse:down').off('mouse:move').off('mouse:up');
            canvas.isDrawingMode = false;
            canvas.defaultCursor = 'crosshair';

            let isDown, origX, origY;
            canvas.on('mouse:down', function (o) {
                canvas.selection = false;
                isDown = true;
                var pointer = canvas.getPointer(o.e);
                origX = pointer.x;
                origY = pointer.y;
                circle = new fabric.Circle({
                    left: origX,
                    top: origY,
                    originX: 'left',
                    originY: 'top',
                    radius: pointer.x - origX,
                    angle: 0,
                    fill: '',
                    stroke: selectedStrokeColor,
                    strokeWidth: penStrokeWidth,
                });
                canvas.add(circle).setActiveObject(circle);
            });
            canvas.on('mouse:move', function (o) {
                if (!isDown) return;
                var pointer = canvas.getPointer(o.e);
                var radius = Math.max(Math.abs(origY - pointer.y), Math.abs(origX - pointer.x)) / 2;
                if (radius > circle.strokeWidth) {
                    radius -= circle.strokeWidth / 2;
                }
                circle.set({radius: radius});
                if (origX > pointer.x) {
                    circle.set({originX: 'right'});
                } else {
                    circle.set({originX: 'left'});
                }
                if (origY > pointer.y) {
                    circle.set({originY: 'bottom'});
                } else {
                    circle.set({originY: 'top'});
                }
                canvas.requestRenderAll();
            });
            canvas.on('mouse:up', function (o) {
                isDown = false;
                let activeObject = canvas.getActiveObject();
                if (activeObject) {
                    activeObject.setCoords();  //allows object to be selectable and moveable
                }
                canvas.off('mouse:down').off('mouse:move').off('mouse:up');
                canvas.defaultCursor = '';
                canvas.requestRenderAll();
            });
        });

    }

    // Line
    const penLineFunction = (canvas) => {
        penLine.addEventListener('click', () => {

            document.getElementById('strokeColor').style.display = 'none';
            document.getElementById('fillColor').style.display = 'none';
            document.getElementById('penColor').style.display = 'block';

            canvas.off('mouse:down').off('mouse:move').off('mouse:up');
            canvas.isDrawingMode = false;
            canvas.selection = false;
            canvas.defaultCursor = 'crosshair';

            let isDown;
            canvas.on('mouse:down', function (o) {
                isDown = true;
                let pointer = canvas.getPointer(o.e);
                let points = [pointer.x, pointer.y, pointer.x, pointer.y];
                line = new fabric.Line(points, {
                    strokeWidth: penStrokeWidth,
                    //fill: selectedStrokeColor,
                    stroke: 'rgba(253,61,61,1)',
                    hasBorders: true,
                    hasControls: true,
                    objectCaching: false,
                    originX: 'center',
                    originY: 'center'
                });
                canvas.add(line).setActiveObject(line);
            });

            canvas.on('mouse:move', function (o) {
                if (!isDown) return;
                var pointer = canvas.getPointer(o.e);
                line.set({x2: pointer.x, y2: pointer.y});
                canvas.requestRenderAll();
            });

            canvas.on('mouse:up', function (o) {
                isDown = false;
                let activeObject = canvas.getActiveObject();
                if (activeObject) {
                    activeObject.setCoords();  //allows object to be selectable and moveable
                }
                canvas.off('mouse:down').off('mouse:move').off('mouse:up');
                canvas.defaultCursor = '';
                canvas.requestRenderAll();
            });

        })
    }

    // Arrow
    // Extended fabric line class
    fabric.LineArrow = fabric.util.createClass(fabric.Line, {

        type: 'lineArrow',

        initialize: function (element, options) {
            options || (options = {});
            this.callSuper('initialize', element, options);
        },

        toObject: function () {
            return fabric.util.object.extend(this.callSuper('toObject'));
        },

        _render: function (ctx) {
            this.ctx = ctx;
            this.callSuper('_render', ctx);
            let p = this.calcLinePoints();
            let xDiff = this.x2 - this.x1;
            let yDiff = this.y2 - this.y1;
            let angle = Math.atan2(yDiff, xDiff);
            this.drawArrow(angle, p.x2, p.y2, this.heads[0]);
            ctx.save();
            xDiff = -this.x2 + this.x1;
            yDiff = -this.y2 + this.y1;
            angle = Math.atan2(yDiff, xDiff);
            this.drawArrow(angle, p.x1, p.y1, this.heads[1]);
        },

        drawArrow: function (angle, xPos, yPos, head) {
            this.ctx.save();

            if (head) {
                this.ctx.translate(xPos, yPos);
                this.ctx.rotate(angle);
                this.ctx.beginPath();
                // Move 5px in front of line to start the arrow so it does not have the square line end showing in front (0,0)
                this.ctx.moveTo(10, 0);
                this.ctx.lineTo(-15, 15);
                this.ctx.lineTo(-15, -15);
                this.ctx.closePath();
            }

            this.ctx.fillStyle = this.stroke;
            this.ctx.fill();
            this.ctx.restore();
        }
    });

    fabric.LineArrow.fromObject = function (object, callback) {
        callback && callback(new fabric.LineArrow([object.x1, object.y1, object.x2, object.y2], object));
    };

    fabric.LineArrow.async = true;

    var Arrow = (function () {
        function Arrow(canvas) {
            this.canvas = canvas;
            this.className = 'Arrow';
            this.isDrawing = false;
            this.bindEvents();
        }

        Arrow.prototype.bindEvents = function () {
            var inst = this;
            inst.canvas.on('mouse:down', function (o) {
                inst.onMouseDown(o);
            });
            inst.canvas.on('mouse:move', function (o) {
                inst.onMouseMove(o);
            });
            inst.canvas.on('mouse:up', function (o) {
                inst.onMouseUp(o);
            });
            inst.canvas.on('object:moving', function (o) {
                inst.disable();
            })
        }

        Arrow.prototype.onMouseUp = function (o) {
            var inst = this;
            this.line.set({
                dirty: true,
                objectCaching: true
            });
            this.canvas.off('mouse:down').off('mouse:move').off('mouse:up');
            inst.canvas.renderAll();
            inst.disable();
        };

        Arrow.prototype.onMouseMove = function (o) {
            var inst = this;
            if (!inst.isEnable()) {
                return;
            }

            var pointer = inst.canvas.getPointer(o.e);
            var activeObj = inst.canvas.getActiveObject();
            activeObj.set({
                x2: pointer.x,
                y2: pointer.y
            });
            activeObj.setCoords();
            inst.canvas.renderAll();
        };

        Arrow.prototype.onMouseDown = function (o) {
            canvas.isDrawingMode = false;
            var inst = this;
            inst.enable();
            var pointer = inst.canvas.getPointer(o.e);

            var points = [pointer.x, pointer.y, pointer.x, pointer.y];
            this.line = new fabric.LineArrow(points, {
                strokeWidth: 4,
                fill: 'rgba(253,61,61,1)',
                stroke: 'rgba(253,61,61,1)',
                originX: 'center',
                originY: 'center',
                hasBorders: false,
                hasControls: false,
                objectCaching: false,
                perPixelTargetFind: true,
                heads: [1, 0]
            });

            inst.canvas.add(this.line).setActiveObject(this.line);
        };

        Arrow.prototype.isEnable = function () {
            return this.isDrawing;
        }

        Arrow.prototype.enable = function () {
            this.isDrawing = true;
        }

        Arrow.prototype.disable = function () {
            this.isDrawing = false;
        }

        return Arrow;
    }());


    const textToolFunction = (canvas) => {
        toolText.addEventListener('click', () => {
            textToolbar.classList.remove('hasRemove');
            penToolbar.classList.add('hasRemove');
            imageToolbar.classList.add('hasRemove');

            canvas.isDrawingMode = false;
            canvas.defaultCursor = 'text';

            let isDown, origX, origY;
            canvas.on('mouse:down', function (o) {
                isDown = true;
                let pointer = canvas.getPointer(o.e);
                origX = pointer.x;
                origY = pointer.y;
                text = new fabric.IText('Sample text...', {
                    left: origX,
                    top: origY,
                    editable: true,
                    fill: '#222222',
                    fontFamily: fontFamily,
                    fontSize: 40
                });

                canvas.add(text).setActiveObject(text);
                canvas.requestRenderAll();
            });
            canvas.on('mouse:up', function (o) {
                isDown = false;
                let textActiveObject = canvas.getActiveObject();
                textActiveObject.setCoords();  //allows object to be selectable and moveable
                canvas.off('mouse:down').off('mouse:move').off('mouse:up');
                canvas.defaultCursor = '';
            });

        })

        textSize.addEventListener('change', () => {
            textSizeValue = textSize.options[textSize.selectedIndex].value;
            //console.log(penSizeValue);
            textSizeValue = parseInt(textSizeValue);
            let activeObject = canvas.getActiveObject();
            if (activeObject !== null) {
                activeObject.set('fontSize', textSizeValue);
            }
            canvas.requestRenderAll();
        })

        let isBold = false;
        textBold.addEventListener('click', () => {
            isBold = !isBold;
            //console.log(isBold)
            //const textLayer = canvas.getObjects()[0];
            let activeObject = canvas.getActiveObject();
            if (activeObject) {
                if (isBold) {
                    activeObject.setSelectionStyles({fontStyle: 'bold'});
                } else {
                    activeObject.setSelectionStyles({fontStyle: 'normal'});
                }
            }

            canvas.requestRenderAll();
        })

        let isItalic = false;
        textItalic.addEventListener('click', () => {
            isItalic = !isItalic
            let activeObject = canvas.getActiveObject();
            if (activeObject) {
                if (isItalic) {
                    activeObject.setSelectionStyles({fontStyle: 'italic'});
                } else {
                    activeObject.setSelectionStyles({fontStyle: 'normal'});
                }
            }
            canvas.requestRenderAll();
        })

        let isUnderline = false;
        textUnderline.addEventListener('click', () => {
            isUnderline = !isUnderline
            let activeObject = canvas.getActiveObject();
            if (activeObject) {
                if (isUnderline) {
                    activeObject.setSelectionStyles({underline: true});
                } else {
                    activeObject.setSelectionStyles({underline: false});
                }
            }

            canvas.requestRenderAll();
        })

        textAlignJustify.addEventListener('click', () => {
            let activeObject = canvas.getActiveObject();
            if (activeObject) {
                activeObject.set('textAlign', 'justify');
            }
            canvas.requestRenderAll();
        })
        textAlignLeft.addEventListener('click', () => {
            let activeObject = canvas.getActiveObject();
            if (activeObject) {
                activeObject.set('textAlign', 'left');
            }
            canvas.requestRenderAll();
        })
        textAlignCenter.addEventListener('click', () => {
            let activeObject = canvas.getActiveObject();
            if (activeObject) {
                activeObject.set('textAlign', 'center');
            }
            canvas.requestRenderAll();
        })
        textAlignRight.addEventListener('click', () => {
            let activeObject = canvas.getActiveObject();
            if (activeObject) {
                activeObject.set('textAlign', 'right');
            }
            canvas.requestRenderAll();
        })

    }


    const imageToolFunction = (canvas) => {
        toolImage.addEventListener('click', openDialog);

        function openDialog() {
            imageUpload.click();
            imageToolbar.classList.remove('hasRemove');
            penToolbar.classList.add('hasRemove');
            textToolbar.classList.add('hasRemove');
        }

        imageUpload.addEventListener('change', (e) => {
            let file = e.target.files[0];
            let reader = new FileReader();
            reader.onload = function (f) {
                let data = f.target.result;
                fabric.Image.fromURL(data, function (img) {
                    image = img.set({
                        left: 50,
                        top: 100,
                        angle: 0,
                    });
                    canvas.add(image).setActiveObject(image);
                    canvas.requestRenderAll();
                });
            };
            reader.readAsDataURL(file);
        })

    }

    // Load the SVG to the canvas when it gets clicked on
    const loadSVG = (canvas) => {
        $('.icons-svg').on('click', 'svg', function () {
            canvas.isDrawingMode = false;
            var serializer = new XMLSerializer(),
                svgStr = serializer.serializeToString(this);

            fabric.loadSVGFromString(svgStr, function (objects, options) {
                options.id = this.id;
                let svg = fabric.util.groupSVGElements(objects, options);
                svg.set({ left: 200, top: 200, name: "svgPosition" }).setCoords();
                canvas.add(svg);

                svg.scaleToHeight(127) // Scales it down to some small size
                    .scaleToWidth(90)
                    .setCoords();

                canvas.setActiveObject(svg).renderAll();
            });
        });
    }

    // Copy and Paste object from Button
    const copyPasteToolFunction = (canvas) => {
        toolCopy.addEventListener('click', function () {

            if (canvas.getActiveObject()) {
                copyObject();
            } else {
                alert('please select an object to copy');
            }


            if (typeof _clipboard !== 'undefined') {
                pasteObject();
            }
        });
    }

    const undoRedoFunction = (canvas) => {
        // Undo + Redo
        //variables for undo/redo
        let pause_saving = false;
        let undo_stack = [];
        let redo_stack = [];

        canvas.on('object:added', function () {
            if (!pause_saving) {
                undo_stack.push(JSON.stringify(canvas));
                redo_stack = [];
                //console.log('Object added, state saved');
            }
        });
        canvas.on('object:modified', function () {
            if (!pause_saving) {
                undo_stack.push(JSON.stringify(canvas));
                redo_stack = [];
                //console.log('Object added, state saved');
            }
        });
        canvas.on('object:removed', function () {
            if (!pause_saving) {
                undo_stack.push(JSON.stringify(canvas));
                redo_stack = [];
                //console.log('Object removed, state saved');
            }
        });

        //Listen for undo
        toolUndo.addEventListener('click', function () {
            pause_saving = true;
            redo_stack.push(undo_stack.pop());
            let previous_state = undo_stack[undo_stack.length - 1];
            if (previous_state == null) {
                previous_state = '{}';
            }
            canvas.loadFromJSON(previous_state, function () {
                canvas.requestRenderAll();
            })
            pause_saving = false;
        });

        //Listen for redo
        toolRedo.addEventListener('click', function (event) {
            pause_saving = true;
            let state = redo_stack.pop();
            if (state != null) {
                undo_stack.push(state);
                canvas.loadFromJSON(state, function () {
                    canvas.requestRenderAll();
                })
                pause_saving = false;
            }
        });


        //Listen for undo/redo from Keyboard
        document.addEventListener('keydown', function (event) {
            //Undo - CTRL+Z
            if (event.ctrlKey && event.keyCode === 90) {
                pause_saving = true;
                redo_stack.push(undo_stack.pop());
                let previous_state = undo_stack[undo_stack.length - 1];
                if (previous_state == null) {
                    previous_state = '{}';
                }
                canvas.loadFromJSON(previous_state, function () {
                    canvas.requestRenderAll();
                })
                pause_saving = false;
            }
            //Redo - CTRL+Y
            else if (event.ctrlKey && event.keyCode === 89) {
                pause_saving = true;
                let state = redo_stack.pop();
                if (state != null) {
                    undo_stack.push(state);
                    canvas.loadFromJSON(state, function () {
                        canvas.requestRenderAll();
                    })
                    pause_saving = false;
                }
            }

            // Delete Object on delete key
            else if (46 === event.keyCode) {
                let activeObject = canvas.getActiveObjects();
                if (activeObject) {
                    let objectsInGroup = activeObject;
                    canvas.discardActiveObject();
                    objectsInGroup.forEach(function (object) {
                        canvas.remove(object);
                    });
                }
            }
        });
    }

    // Clear canvas
    const removeAllToolFunction = (canvas) => {
        toolRemoveAll.addEventListener('click', () => {
            canvas.clear();
            canvas.backgroundColor = 'white';
            canvas.requestRenderAll();
        })
    }


    function zoomIn() {

        canvasScale = canvasScale * SCALE_FACTOR;

        canvas.setHeight(canvas.getHeight() * SCALE_FACTOR);
        canvas.setWidth(canvas.getWidth() * SCALE_FACTOR);

        var objects = canvas.getObjects();
        for (var i in objects) {
            var scaleX = objects[i].scaleX;
            var scaleY = objects[i].scaleY;
            var left = objects[i].left;
            var top = objects[i].top;

            var tempScaleX = scaleX * SCALE_FACTOR;
            var tempScaleY = scaleY * SCALE_FACTOR;
            var tempLeft = left * SCALE_FACTOR;
            var tempTop = top * SCALE_FACTOR;

            objects[i].scaleX = tempScaleX;
            objects[i].scaleY = tempScaleY;
            objects[i].left = tempLeft;
            objects[i].top = tempTop;

            objects[i].setCoords();
        }


        canvas.renderAll();
    }

    function zoomOut (){

        canvasScale = canvasScale / SCALE_FACTOR;

        canvas.setHeight(canvas.getHeight() * (1 / SCALE_FACTOR));
        canvas.setWidth(canvas.getWidth() * (1 / SCALE_FACTOR));

        var objects = canvas.getObjects();
        for (var i in objects) {
            var scaleX = objects[i].scaleX;
            var scaleY = objects[i].scaleY;
            var left = objects[i].left;
            var top = objects[i].top;

            var tempScaleX = scaleX * (1 / SCALE_FACTOR);
            var tempScaleY = scaleY * (1 / SCALE_FACTOR);
            var tempLeft = left * (1 / SCALE_FACTOR);
            var tempTop = top * (1 / SCALE_FACTOR);

            objects[i].scaleX = tempScaleX;
            objects[i].scaleY = tempScaleY;
            objects[i].left = tempLeft;
            objects[i].top = tempTop;

            objects[i].setCoords();
        }

        canvas.renderAll();
    }


    // Download Button
    const downloadBtnFunction = (canvas) => {
        // Download button
        downloadBtn.addEventListener('click', function () {

            let canvasObjects = canvas.getObjects();

            if (canvasObjects.length > 0) {
                let width = canvas.width;
                let height = canvas.height;
                window.jsPDF = window.jspdf.jsPDF;

                //set the orientation
                if (width > height) {
                    pdf = new jsPDF('l', 'px', [width, height]);
                } else {
                    pdf = new jsPDF('p', 'px', [height, width]);
                }
                //then we get the dimensions from the 'pdf' file itself
                width = pdf.internal.pageSize.getWidth();
                height = pdf.internal.pageSize.getHeight();
                let imgData = canvas.toDataURL('image/jpeg', 1.0);
                //console.log(imgData)
                pdf.addImage(imgData, 'PNG', 0, 0, width, height);

                let fineName = $('#fileName').val().trim();
                if (fineName) {
                    pdf.save(`${fineName}.pdf`);
                } else {
                    pdf.save("download.pdf");
                }

            } else {
                toastr['warning']('', 'Canvas is empty. Nothing to download', {
                    positionClass: 'toast-bottom-right',

                });
            }
        });
    }


    // Save to Database as json
    const saveJsonToDatabase = (canvas) => {
        $('#saveBtn').click(function (event) {
            /* stop form from submitting normally */
            let json = JSON.stringify(canvas);
            let imgData = canvas.toDataURL('image/jpeg', 1.0);
            //console.log(template)

            let canvasObjects = canvas.getObjects();
            //console.log(canvasObjects)

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            });


            if (canvasObjects.length > 0) {


                if (json) {

                    let saveFileName = $('#saveFileName').val().trim();
                    if (saveFileName) {
                        //ajax post the form
                        $.ajax({
                            type: "POST",
                            url: '/template',
                            data: {
                                json: json,
                                image: imgData,
                                name: saveFileName
                            },
                            success: function (response) {
                                //console.log(response)
                                toastr['success']('', 'PDF Saved', {
                                    positionClass: 'toast-bottom-right',
                                });

                                //window.location = '/create';
                                setTimeout(() => {
                                    window.location = '/create';
                                }, 2000);
                            }
                        });
                    } else {
                        toastr['warning']('', 'Please insert File Name', {
                            positionClass: 'toast-bottom-right',

                        });
                    }

                } else {
                    toastr['warning']('', 'Something went wrong', {
                        positionClass: 'toast-bottom-right',

                    });
                }
            } else {
                toastr['warning']('', 'Canvas is empty. Nothing to save', {
                    positionClass: 'toast-bottom-right',

                });
            }
        });
    }

    // Update to Database as json
    const updateJsonToDatabase = (canvas) => {
        $('#updateBtn').click(function (event) {
            /* stop form from submitting normally */
            let json = JSON.stringify(canvas);
            let imgData = canvas.toDataURL('image/jpeg', 1.0);
            //console.log(template)

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            });

            if (json) {

                let templateID = $("#templateID").val();
                let updateFileName = $('#updateFileName').val().trim();

                $.ajax({
                    type: "PUT",
                    url: `/edit/${templateID}`,
                    data: {
                        json: json,
                        image: imgData,
                        name: updateFileName
                    },
                    success: function (response) {
                        //console.log(response)
                        //window.location = '/hi';
                        toastr['success']('', 'PDF Updated', {
                            positionClass: 'toast-bottom-right',

                        });
                    }
                });
            } else {
                alert("Did not send data");
            }
        });
    }

    // Load json object from database
    const loadJsonObjectFromDb = (canvas) => {
        let jsonID = $("#jsonID").val();
        //console.log(jsonID)
        canvas.loadFromJSON(jsonID, function () {
            canvas.requestRenderAll();
        }, function (o, object) {
            //console.log(o,object)
        })
    }

    // $('#toolZoomIn').on('click', function(event) {
    //     zoomIn();
    // });
    //
    // $('#toolZoomOut').on('click', function(event) {
    //     zoomOut();
    // });


    /*======================  Canvas Init  =======================*/
    let canvas = this.__canvas = new fabric.Canvas('canvas');
    canvas.setDimensions({width: 1125, height: 1500});
    canvas.backgroundColor = 'white';
    //console.log(canvas._objects);
    canvas.selection = false;
    canvas.defaultCursor = '';


    /*=======  Copy Paste Active Object Keyboard  =======*/
    //copyAndPasteObjectKeyboard(canvas);

    /*=======  Select Tool  =======*/
    toolSelectFunction(canvas);

    toolPenFunction(canvas);
    penFreeHandFunction(canvas);
    penRectFunction(canvas);
    penEllipseFunction(canvas);
    penLineFunction(canvas);
    penSizeFunction(canvas);

    penArrow.addEventListener('click', () => {

        document.getElementById('strokeColor').style.display = 'none';
        document.getElementById('fillColor').style.display = 'none';
        document.getElementById('penColor').style.display = 'block';

        canvas.off('mouse:down').off('mouse:move').off('mouse:up');
        canvas.selection = false;
        let arrow = new Arrow(canvas);
        canvas.requestRenderAll();
    })

    textToolFunction(canvas);
    fontSelectFunction(canvas);
    imageToolFunction(canvas);
    imageOpacityFunction(canvas);
    // Load SVG
    loadSVG(canvas);

    removeObjectFunction(canvas);

    selectedObjectToolBar(canvas);

    // Upper Tools
    copyPasteToolFunction(canvas);
    undoRedoFunction(canvas);
    removeAllToolFunction(canvas);

    // Download PDF
    downloadBtnFunction(canvas);

    // Save to database Ajax
    saveJsonToDatabase(canvas);

    // Update to database Ajax
    updateJsonToDatabase(canvas);

    // Load JSON object from database
    loadJsonObjectFromDb(canvas);



})();
