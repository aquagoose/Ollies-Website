async function ParseEditorToHtml(editor) { // Convert the editor JSON to HTML.
    let html = "";
    let outputData = await editor.save(); // Save the editor's data
    for (const block of outputData["blocks"]) {
        switch(block["type"]) { // Get the type of block.
            case "header":
                const headerType = block["data"]["level"]; // Get the type of header (h1, h2 etc)
                html += `<h${headerType}>${block["data"]["text"]}</h${headerType}>`; // Since the level is just a number, append it to the <h> in header.
                break;
            case "paragraph":
                html += `<p>${block["data"]["text"]}</p>` // Create a new paragraph with the text.
                break;
        }
    }
    return html; // Return the HTML back to the pesky webpage.
}

async function ParseHtmlToEditorFormat(html) { // Parse HTML back into a JSON format that the editor can read.
    let json = {blocks: []}; // Predefines the json with some blocks
    let splitHtml = []; // This is the final split html, format: ["tag", "following content"]
                        // So for example, ["h1", "Nice"] means an h1 tag with "nice" as its content
                        // Or something like: [["a href="page"", "Epic"], ["/a", "Good link that is"]]
                        // The first array is the link content, the second array contains the text after the inline link.

    html = html.split("<"); // First split the html by left angle bracket. This gets a list of all the separate tags
    for (const word of html) {
        splitHtml.push(word.split(">")); // Then split each list item again by the right angle bracket. This gets a 2D array of tags + content, described above.
    }

    for (const line of splitHtml) { // Do the HTML interpreting.
        if (line[0].startsWith("h")) { // Headers start with h. This gets the specific level of the header too.
            json["blocks"].push({"type": "header", "data": {"text": line[1], "level": line[0].substring(1)}}); // Push the correct text data to the string.
        }
        else if (line[0] === "p") // Paragraph
            json["blocks"].push({ "type": "paragraph", "data": { "text": line[1] } });
        else if (line[0].startsWith("br")) // Break
            json["blocks"][json["blocks"].length-1]["data"]["text"] += "<br>" + line[1];
        else if (line[0].startsWith("a")) { // Links.
            json["blocks"][json["blocks"].length - 1]["data"]["text"] += `<a href="${line[0].split("href=\"")[1]}">${line[1]}</a>`; // This strips out the href too so the link goes to the right place.
        }
        else if (line[0] === "/a") { // End of links. Since links are inline, you need to get the data following it too.
            json["blocks"][json["blocks"].length - 1]["data"]["text"] += line[1];
        }
        else if (line[0] === "i") // Italic.
            json["blocks"][json["blocks"].length - 1]["data"]["text"] += `<i>${line[1]}</i>`;
        else if (line[0] === "/i") // Same thing with links.
            json["blocks"][json["blocks"].length - 1]["data"]["text"] += line[1];
    }
    return json;
}